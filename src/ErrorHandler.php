<?php
/**
 * Created by PhpStorm.
 * User: paulius
 * Date: 18.6.25
 * Time: 14.28
 */

namespace Demo;

use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;
use Demo\Settings;
use Demo\User;


class ErrorHandler
{
    private $Settings;
    private $User;

    public function __construct(Settings $Settings, User $User)
    {
        $this->Settings = $Settings;
        $this->User = $User;
    }

    private function logToRollbar($errorData) {
        // ROLLBAR

        Rollbar::init(
            [
                'access_token' => $this->Settings->getRollbarAccessTokenPhp(),
                'environment' => $this->Settings->getEnvironment(),
                'capture_username' => true,
                'capture_email' => true,
                'person_fn' => function () {
                    return array(
                        'id' => $this->User->getId(), // required - value is a string
                        'username' => $this->User->getUsername(), // optional - value is a string
                        'email' => $this->User->getEmail() // optional - value is a string
                    );
                }
            ]
        );

        $code = $errorData->getCode();

        switch($code) {
            case 1:     // E_ERROR
                $level = Level::ERROR;
                break;
            case 2:     // E_WARNING
            case 32:    // E_CORE_WARNING
                $level = Level::WARNING;
                break;
            case 8:     // E_NOTICE
            case 8192:
                $level = Level::NOTICE;
                break;
            case 16:
                $level = Level::CRITICAL;
                break;
            case 64:
                $level = Level::EMERGENCY;
                break;
            case 4096:
                $level = Level::ALERT;
                break;
            case 8192:
                $level = Level::INFO;
                break;
            default:
                //$level = Level::DEBUG;
                $level = Level::ERROR;
                break;
        }


        return Rollbar::log($level, $errorData);
    }

    public function handleExceptionsWithRollbar(\Throwable $e)
    {
        $response = $this->logToRollbar($e);

        if (!$response->wasSuccessful()) {
            throw new \Exception('Logging (1) with Rollbar failed.');
        }
    }

    public function handleFatalsWithRollbar() {
//        $errfile = "unknown file";
//        $errstr  = "shutdown";
//        $errno   = E_CORE_ERROR;
//        $errline = 0;

        $error = error_get_last();

        if( $error !== NULL) {
            $errno   = $error["type"];
//            $errfile = $error["file"];
//            $errline = $error["line"];
            $errstr  = $error["message"];

            throw new \Exception($errstr, $errno);
        }
    }

    public function handleErrorsWithRollbar(int $errno , string $errstr, string $errfile, int $errline, array $errcontext) {

        // error was suppressed with the @-operator
//        if (0 === error_reporting()) {
//            return false;
//        }

        //var_dump(999999); die();
        throw new \Exception($errstr, $errno);

//        $response = $this->logToRollbar(json_encode([
//            'errno' => $errno,
//            'errstr' => $errstr,
//            'errfile' => $errfile,
//            'errline' => $errline,
//            'errcontext' => $errcontext,
//        ]));

//        if (!$response->wasSuccessful()) {
//            throw new \Exception('Logging (2) with Rollbar failed.');
//        }

    }

    // to read:
    // https://stackoverflow.com/questions/1241728/can-i-try-catch-a-warning
    // http://php.net/manual/en/function.set-exception-handler.php
    // https://www.w3schools.com/js/js_errors.asp
    // https://docs.rollbar.com/docs/javascript
    // https://github.com/rollbar/pyrollbar/pull/262/files
    // https://rollbar.com/sugalvojau/DemoProject-JavaScript/items/
    // https://rollbar.com/sugalvojau/_/items/

}