<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Mail;
use File;
use Storage;
class DailyBackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database Mail to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email="subudhitechnoengineers@gmail.com";
        $uname="abc";
        $password=public_path("dbbackup/liveDB_".date("Y").date('m').date('d')."_0000.sql");
        
        $file="dbbackup/liveDB_".date("Y").date('m').date('d')."_0000.sql";


 $name=$file;
         $mail= Mail::send('mail.mail', compact('email','uname','password','name','file'), function($message) use($email) {
     $message->to($email, 'Primary Client');
     $message->cc($email,'Primary Client');
     $message->subject('Registration Confirmation');
     $message->attach(public_path("dbbackup/liveDB_".date("Y").date('m').date('d')."_0000.sql"));
     
         $message->from('subudhitechnoengineers@gmail.com','Subudhi Technoengineers');
        
      });
     $this->info('Hourly Update has been send successfully');
    }
}
