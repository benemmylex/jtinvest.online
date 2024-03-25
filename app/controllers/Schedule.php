<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 4/27/2018
 * Time: 1:10 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller
{

    public function crypto_payment_confirm () {
        $this->load->model("Crypto_payment_model", "crypto");
        $s = $this->Db_model->selectGroup("*", "user_wallet", "WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $order = $this->crypto->confirm_order($row['ref']);
                if ($order['status']) {
                    $this->Db_model->update("user_wallet", ["status"=>1], "WHERE ref='$row[ref]'");
                } else {
                    $this->Db_model->update("user_wallet", ["status"=>2], "WHERE ref='$row[ref]'");
                }
            }
        }
    }

    public function investment_profit () {
        $s = $this->Db_model->selectGroup("*", "investment", "WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $date_split = explode(" ", $row['start']);
                $plan = $this->Util_model->get_info("plans", "*", "WHERE id=$row[plan]");
                if ($row['duration'] > 0 && $date_split[0] != date_time('d')) {
                    $daily_profit = $plan['roi'];
                    $roi = get_percentage($row['amount'], $daily_profit);
                    $profit = $row['profit'] + $roi;
                    $duration = $row['duration'] - 1;
                    $this->Main_model->add_to_bonus(
                        $roi,
                        $row['uid'],
                        0,
                        "ROI",
                        "",
                        1
                    ); //ROI bonus
                    $this->Db_model->update("investment", ["duration" => $duration, "profit" => $profit], "WHERE id=$row[id]");
                    if ($duration == 0) {
                        $this->Db_model->update("investment", ["status" => 1], "WHERE id=$row[id]");
                        $this->Main_model->add_to_wallet(
                            get_percentage($row['amount'], $plan['cashout']),
                            $row['uid'],
                            0,
                            "Capital return",
                            "Capital return",
                            "Cashout",
                            $row['id'],
                            "",
                            1
                        ); //Capital return
                    }
                }
            }
        }
            
        /*$s = $this->Db_model->selectGroup("*", "investment", "WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $date_split = explode(" ", $row['end']);
                $plan = $this->Util_model->get_info("plans", "*", "WHERE id=$row[plan]");
                if ($row['duration'] == 0) {
                    $this->Db_model->update("investment", ["status" => 1], "WHERE id=$row[id]");
                } else {
                    //$end_date = get_next_prev_date(date_time(), 7, "next", "Y-m-d H:i:s");
                    $date = explode(" ", $row['start']);
                    if ($date[0] != date_time('d')) {
                        $duration = $row['duration'] - 1;
                        if ($duration == 0) {
                            $daily_profit = $plan['roi'];
                            $roi = get_percentage($row['amount'], $daily_profit);
                            
                            
                            $this->Db_model->update("investment", ["duration" => $duration, "profit" => $roi, "status" => 1], "WHERE id=$row[id]");
                        } else {
                            $this->Db_model->update("investment", ["duration" => $duration], "WHERE id=$row[id]");
                        }
                    }
                }
            }
        }*/
    }

    public function bot () {
        $fh = fopen('bot.txt','r');
        $inserts = 0;
        while ($line = fgets($fh)) {
            // <... Do your work with the line ...>
            // echo $line . "<br>";
            $word = trim($line);
            $count = strlen($word);
            $uid = rand(11111111, 99999999);
            $emails = array('gmail.com', 'yahoo.com', 'hotmail.com');
            $numb = rand(11,99);
            shuffle($emails);
            $line = trim($line);
            $data = [
                "user_main" =>  [
                    "uid"       =>  $uid,
                    "name"      =>  $line,
                    "status"    =>  1
                ],
                "user_profile"  =>  [
                    "uid"       =>  $uid,
                    "username"  =>  strtoupper($line).$numb,
                    "email"     =>  strtoupper($line).$numb."@".$emails[0],
                    "role"      =>  0,
                    "password"  =>  base64_encode("password")
                ]
            ];
            foreach ($data as $table => $input) {
                $this->Db_model->insert($table, $input);
            }
        }
        fclose($fh);
    }

}