<?php
class Budget extends Model
{
    public function getIncomeDetails($event_id)
    {/*get income details from backend to the UI*/
        $query = 'SELECT CONCAT("INC",`record_id`) as record_id, `time_stamp`, `event_id`, `uid`, `status`, `details`, `amount` FROM income where event_id=:event_id AND status = "current" ';
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);
        return $result;
    }

    public function getExpenseDetails($event_id)
    {/*get expense details from backend to the UI*/
        $query = 'SELECT CONCAT("EXP",`record_id`) as record_id, `time_stamp`, `event_id`, `uid`, `status`, `details`, `amount` FROM expense where event_id=:event_id AND status = "current" ';
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);

        return $result;
    }

    public function addIncome($data)
    {/*add incomes to the budget*/
        $data["uid"] = $_SESSION["user"]["uid"];
        $query = 'INSERT INTO `income` (`details`, `amount`, `uid`, `event_id`) VALUES (:details,  :amount, :uid, :event_id)';
        $params = array_intersect_key($data, ["details" => '', "amount" => '', "uid" => '', "event_id" => '']);
        Model::insert($query, $params);
    }

    public function addExpense($data)
    {/*add expenses to the budget*/
        $data["uid"] = $_SESSION["user"]["uid"];
        $query = 'INSERT INTO `expense` (`details`, `amount`, `uid`, `event_id`) VALUES (:details,  :amount, :uid, :event_id)';
        $params = array_intersect_key($data, ["details" => '', "amount" => '', "uid" => '', "event_id" => '']);
        Model::insert($query, $params);
    }

    public function updateIncome($data)
    {/*update incomes by an insert query*/
        extract($data, EXTR_OVERWRITE);
        $record_id = str_replace("INC", "", $record_id);
        $db = Model::getDB();
        $db->beginTransaction();
        $uid = $_SESSION["user"]["uid"];

        /*update income and set the status as updated*/
        $query = "UPDATE income SET status = 'updated' WHERE record_id = :record_id ORDER BY time_stamp DESC LIMIT 1";
        $params = ["record_id" => $record_id];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $stmt->closeCursor();

        $query = "SELECT event_id FROM income WHERE record_id = :record_id";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchColumn();
        $stmt->closeCursor();

        /*create new income with status as current*/
        $event_id = $result;
        $query = "INSERT INTO income (event_id, status, uid, details, amount, record_id) VALUES (:event_id, 'current', :uid, :details, :amount, :record_id)";
        $params = ["record_id" => $record_id, "event_id" => $event_id, "uid" => $uid, "details" => $details, "amount" => $amount];
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $db->commit();
    }

    public function updateExpense($data)
    {/*update expenses by an insert query*/
        extract($data, EXTR_OVERWRITE);
        $record_id = str_replace("EXP", "", $record_id);
        $db = Model::getDB();
        $db->beginTransaction();

        $uid = $_SESSION["user"]["uid"];

        /*update income and set the status as updated*/
        $query = "UPDATE expense SET status = 'updated' WHERE record_id = :record_id ORDER BY time_stamp DESC LIMIT 1";
        $params = ["record_id" => $record_id];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $stmt->closeCursor();

        $query = "SELECT event_id FROM expense WHERE record_id = :record_id";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchColumn();
        $stmt->closeCursor();

        /*create new income with status as current*/
        $event_id = $result;
        $query = "INSERT INTO expense (event_id, status, uid, details, amount, record_id) VALUES (:event_id, 'current', :uid, :details, :amount, :record_id)";
        $params = ["record_id" => $record_id, "event_id" => $event_id, "uid" => $uid, "details" => $details, "amount" => $amount];
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $db->commit();
    }

    public function deleteIncome($data)
    {/*delete incomes with an insert query*/
        extract($data, EXTR_OVERWRITE);
        $record_id = str_replace("INC", "", $record_id);
        $db = Model::getDB();
        $db->beginTransaction();

        $uid = $_SESSION["user"]["uid"];

        $query = "UPDATE income SET status = 'updated' WHERE record_id = :record_id ORDER BY time_stamp DESC LIMIT 1";
        $params = ["record_id" => $record_id];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $stmt->closeCursor();

        $query = "SELECT event_id FROM income WHERE record_id = :record_id";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchColumn();
        $stmt->closeCursor();

        /*insert a new record to database, which status as deleted*/
        $event_id = $result;
        $query = "INSERT INTO income (event_id, status, uid, details, amount, record_id) VALUES (:event_id, 'deleted', :uid, :details, :amount, :record_id)";
        $params = ["record_id" => $record_id, "event_id" => $event_id, "uid" => $uid, "details" => "", "amount" => "-1"];
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $db->commit();
    }


    public function deleteExpense($data)
    {/*delete expenses with an insert query*/

        extract($data, EXTR_OVERWRITE);
        $record_id = str_replace("EXP", "", $record_id);
        $db = Model::getDB();
        $db->beginTransaction();
        $uid = $_SESSION["user"]["uid"];

        $query = "UPDATE expense SET status = 'updated' WHERE record_id = :record_id ORDER BY time_stamp DESC LIMIT 1";
        $params = ["record_id" => $record_id];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $stmt->closeCursor();

        $query = "SELECT event_id FROM expense WHERE record_id = :record_id";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchColumn();
        $stmt->closeCursor();

        /*insert a new record to database, which status as deleted*/
        $event_id = $result;
        $query = "INSERT INTO expense (event_id, status, uid, details, amount, record_id) VALUES (:event_id, 'deleted', :uid, :details, :amount, :record_id)";
        $params = ["record_id" => $record_id, "event_id" => $event_id, "uid" => $uid, "details" => "", "amount" => "-1"];
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $db->commit();
    }

    public function getIncomeSum($event_id)
    {
        /*get the sum of all the incomes which the status is current*/
        $query = "SELECT SUM(amount) as income_sum FROM income WHERE event_id =:event_id AND status='current' ";
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);
        $result = ($result[0]["income_sum"] == NULL) ? 0 : $result[0]["income_sum"];
        return $result;
    }

    public function getExpenseSum($event_id)
    {
        /*get the sum of all the expenses which the status is current*/
        $query = "SELECT SUM(amount) as expense_sum FROM expense WHERE event_id =:event_id AND status='current' ";
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);
        $result = ($result[0]["expense_sum"] == NULL) ? 0 : $result[0]["expense_sum"];
        return $result;
    }

    public function getDonationSum($event_id)
    {
        /*get the sum of all the donations*/
        $query = 'SELECT SUM(amount) as donation_sum FROM donation WHERE event_id =:event_id';
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);
        $result = ($result[0]["donation_sum"] == NULL) ? 0 : $result[0]["donation_sum"];
        return $result;
    }

    public function IncomeReportGenerate($event_id)
    {/*generate the report of all the incomes*/
        $query = 'SELECT CONCAT("INC",`record_id`) as record_id, income.amount, income.details, income.status, date(time_stamp) as date, registered_user.username FROM income INNER JOIN registered_user ON income.uid=registered_user.uid WHERE  event_id =:event_id UNION SELECT CONCAT("INC",`record_id`) as record_id, income.amount, income.details, income.status, date(time_stamp) as date, organization.username FROM income INNER JOIN organization ON income.uid=organization.uid WHERE  event_id =:event_id_1';
        $params = ["event_id" => $event_id, "event_id_1" => $event_id];
        $result = Model::select($query, $params);
        return $result;
    }

    public function ExpenseReportGenerate($event_id)
    {/*generate the report of all the incomes*/
        $query = 'SELECT CONCAT("EXP",`record_id`) as record_id, expense.amount, expense.details, expense.status, date(time_stamp) as date, registered_user.username FROM expense INNER JOIN registered_user ON expense.uid=registered_user.uid WHERE event_id =:event_id UNION SELECT CONCAT("EXP",`record_id`) as record_id, expense.amount, expense.details, expense.status, date(time_stamp) as date, organization.username FROM expense INNER JOIN organization ON expense.uid=organization.uid WHERE event_id =:event_id_1 ';
        $params = ["event_id" => $event_id, "event_id_1" => $event_id];
        $result = Model::select($query, $params);
        return $result;
    }

    public function getBudgetReport($data)
    {
        $query = "SELECT SUM(amount) as income_sum ,date_format(time_stamp,'%x-%m-%d') as day FROM income WHERE event_id = :event_id GROUP BY day ORDER BY day ASC";
        $params = ["event_id" => $data["event_id"]];
        $result = Model::select($query, $params);

        if (count($result) == 0)
            return false;
        else
            return $result;
    }

    public function getBudget($event_id)
    {
        $budget = new Budget();
        $income_report = $budget->IncomeReportGenerate($event_id);
        $expense_report = $budget->ExpenseReportGenerate($event_id);

        /*get incomes and expenses and all the details of them in to an array*/
        $data["report"] = $expense_report;
        array_push($data["report"], ...$income_report);
        usort($data["report"], function ($a, $b) {/*sort the data according to date*/
            return $a['date'] <=> $b['date'];
        });
        $data["income_report"] = $income_report;
        $data["expense_report"] = $expense_report;
        $current_report = array();
        foreach ($data["report"] as $report) {
            if ($report["status"] == 'current') {/*get all the current incomes and expenses into an array.*/
                array_push($current_report, $report);
            }
        }
        return $current_report;
    }

    public function getDailyIncomeSum($event_id)
    {
        $query = 'SELECT date_format(time_stamp,"%Y-%m-%d") as day, SUM(amount) as amount FROM income WHERE event_id = :event_id AND (status="current" OR status= "donation") GROUP BY day ORDER BY day ASC';
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);
        return $result;
    }

    public function getDailyExpenseSum($event_id)
    {
        $query = 'SELECT date_format(time_stamp,"%Y-%m-%d") as day, SUM(amount) as amount FROM expense WHERE event_id = :event_id AND status="current" GROUP BY day ORDER BY day ASC';
        $params = ["event_id" => $event_id];
        $result = Model::select($query, $params);
        return $result;
    }

    public function getDailyBalance($event_id)
    {
        $query = 'SELECT day, SUM(balance) FROM (SELECT date_format(time_stamp,"%Y-%m-%d") AS "day", amount as balance FROM income WHERE event_id = :event_id_1 AND status="current" UNION SELECT date_format(time_stamp,"%x-%m-%d") AS "day", amount*(-1) AS balance FROM expense WHERE event_id = :event_id_2 AND status ="current" ) balancetab GROUP BY day ORDER BY day';
        $params = ["event_id_1" => $event_id,"event_id_2" => $event_id];
        $result = Model::select($query, $params);
        return $result;
    }
}
