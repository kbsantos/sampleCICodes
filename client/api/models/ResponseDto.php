<?php
class ResponseDto
{
    public $status;
    public $message;
    public $data;

    public function __construct($status='', $message='', $data=null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    public static function failed($message, $status=false, $data=null)
    {
        return new ResponseDto($status, $message, $data);
    }

    public static function success($data, $status=true, $message='success')
    {
        return new ResponseDto($status, $message, $data);
    }
}