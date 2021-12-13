<?php
    class RequestResponse{
            
        public $success;
        public $message;
        public $destination;

        function __construct($success, $message, $destination){
            $this->success = $success;
            $this->message = $message;
            $this->destination = $destination;
        }
    }
?>