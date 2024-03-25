<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 6/23/2017
 * Time: 1:11 PM
 */
class Ajax extends CI_Controller
{

    public function get_balance () {
        echo $this->General_model->get_balance($this->session->userdata(UID));
    }

    public function update_status () {
        echo $this->Db_model->update("$_POST[table]", ["status"=>$_POST['status']], "WHERE id=$_POST[id]");
    }

    public function calculator () {
        $s = $this->Db_model->selectGroup("*", "plans", "WHERE status=1 ORDER BY min_amt DESC");
        $plan = 0;
        $amount = $_POST["amount"];
        foreach ($s->result_array() as $row) {
            if ($amount >= $row['min_amt']) {
                $plan = $row['roi'];
                break;
            }
        }
        if ($plan > 0) {
            $daily = get_percentage($amount, $plan);
            $weekly = $daily * 5;
            $monthly = $weekly * 4;
            $yearly = $monthly * 6;
            $return = [
                "daily"         =>  USD.count_format($daily),
                "weekly"        =>  USD.count_format($weekly),
                "monthly"       =>  USD.count_format($monthly),
                "yearly"        =>  USD.count_format($yearly)
            ];
        } else {
            $return = [
                "daily"         =>  USD."0",
                "weekly"        =>  USD."0",
                "monthly"       =>  USD."0",
                "yearly"        =>  USD."0"
            ];
        }
        echo json_encode($return);
    }

    public function list_ex_trans () {
        $s = $this->Db_model->selectGroup("*", "user_wallet_ex", "WHERE status=1 ORDER BY id DESC LIMIT 50");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $type = ($row['type'] == "credit") ? "Deposit of \$".number_format($row['amount']) : "Withdrawal of \$".number_format($row['amount']);
                $trans[] = "
                <div class='trans-details'>
                    <img src='".base_url().$this->Util_model->picture($row['uid'])."'> 
                    <p>
                        $type<br>
                        By ".$this->Util_model->get_user_info($row['uid'])."
                    </p>
                </div>
                ";
            }
        } else {
            $trans = array();
        }
        $this->output->set_output(json_encode($trans));
    }

    public function get_investment_details() {
        $amount = $_POST['amount'];
        $row = $this->Util_model->get_info("plans", "*", "WHERE max_amt >= $amount AND status=1 LIMIT 1");
        $this->output->set_output(json_encode(["plan" => "$row[name] ($row[roi]%)", "roi" => $row['roi']]));
    }

}

?>