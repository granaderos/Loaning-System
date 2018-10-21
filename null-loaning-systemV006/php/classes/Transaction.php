<?php
    include "Database_connection.php";

    class Transaction extends Database_connection {

        function check_if_employee_or_username_exist($lastname, $firstname, $username) {
            $this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT * FROM employees WHERE lastname = ? AND firstname = ?;");
            $select_statement->execute(array($lastname, $firstname));

            if($select_statement->fetch()) {
                echo "Employee was already hired!";
            } else {
                $select_statement1 = $this->db_holder->prepare("SELECT a.* FROM accounts AS a,
                                                                                employees AS e
                                                                           WHERE e.employee_id = a.employee_id AND
                                                                                 e.employee_id NOT IN(SELECT employee_id FROM fired_employees) AND
                                                                                 a.username = ?;");
                $select_statement1->execute(array($username));

                if($select_statement1->fetch()) {
                    echo "User name was already taken!";
                }
            }

            $this->close_connection();
        }

        function add_client($last_name, $first_name, $address, $contact, $email, $job, $income, $loan_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $remarks) {
            $this->open_connection();

            $insert_statement1 = $this->db_holder->prepare("INSERT INTO clients VALUES (null, ?, ?, ?, ?, ?, ?, ?);");
            $insert_statement1->execute(array($last_name, $first_name, $address, $contact, $email, $job, $income));

            $client_id = $this->db_holder->lastInsertId();

			$this->add_transaction($client_id, $loan_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $remarks);
			$this->generate_client_account($last_name, $contact);

            $this->close_connection();
            return $client_id;
        }

        function add_transaction($client_id, $loan_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $remarks) {
            //$this->open_connection();

            $insert_statement = $this->db_holder->prepare("INSERT INTO transactions VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?);");
            $insert_statement->execute(array($client_id, $loan_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $remarks));

            //$this->close_connection();
        }

        function display_clients() {
            $this->open_connection();

            $select_statement = $this->db_holder->query("SELECT * FROM clients;");

            $clients = "<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Contact</th>
						<th>Email</th>
						<th>Job</th>
						<th>Income(approx.)</th>
					</tr>";

            while($content = $select_statement->fetch()) {
                $clients .= "<tr  id = 'employee_".$content[0]."' ondblclick = 'show_action_options(".$content[0].")'>
                                            <td>".$content[1].", ".$content[2]."</td>
                                            <td>".$content[3]."</td>
                                            <td>".$content[4]."</td>
                                            <td>".$content[5]."</td>
                                            <td>".$content[6]."</td>
                                            <td>".$content[7]."</td>
                                       </tr>";
            }

            echo $clients;

            $this->close_connection();
        }

		function generate_client_account($last_name, $contact) {

			$insert_statement = $this->db_holder->prepare("INSERT INTO system_accounts VALUES (null, ?, ?, ?)");
			$insert_statement->execute(array("NULL".$last_name, $contact, "client"));
		}

		function display_transactions() {
			$this->open_connection();

            $select_statement = $this->db_holder->query("SELECT c.client_id, c.lastname, c.firstname, t.* FROM clients AS c, transactions AS t WHERE c.client_id = t.client_id;");

            $trans = "<tr>
						<th>Date of Loan</th>
						<th>Client</th>
						<th>Amount | Price</th>
						<th>Balance</th>
						<th>Collateral</th>
						<th>Remarks</th>
						<th>Action</th>
					</tr>";

            while($content = $select_statement->fetch()) {
                $trans .= "<tr title = 'double click to view details' id = 'clientTrans_".$content[0]."' ondblclick = ''>
								<td>".$content[6]."</td>
								<td>".$content[1].", ".$content[2]."</td>
                                <td>".$content[7]."</td>
                                <td>".$content[8]."</td>
                                <td>".$content[9]."</td>
                                 <td>".$content[11]."</td>
                                 <td><button onclick = 'update(".$content[3].")' class = 'btn btn-small'>update</button></td>
                            </tr>";
            }

            echo $trans;

            $this->close_connection();
		}

        function search_client($search_data) {
            $this->open_connection();

			$search_data = '%'.$search_data.'%';

            $select_statement = $this->db_holder->prepare("SELECT * FROM clients WHERE lastname LIKE ? OR firstname LIKE ?;");
			$select_statement->execute(array($search_data, $search_data));

            $count = 0;
            while($content = $select_statement->fetch()) {
				if($count == 0) {
					$clients = "<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Contact</th>
						<th>Email</th>
						<th>Job</th>
						<th>Income(approx.)</th>
					</tr>";
					$count++;
				}
                $clients .= "<tr title = 'double click to show actions' id = 'employee_".$content[0]."' ondblclick = 'show_action_options(".$content[0].")'>
                                            <td>".$content[1].", ".$content[2]."</td>
                                            <td>".$content[3]."</td>
                                            <td>".$content[4]."</td>
                                            <td>".$content[5]."</td>
                                            <td>".$content[6]."</td>
                                            <td>".$content[7]."</td>
                                       </tr>";
            }
			if($clients == "") {
				$clients = "No result for ".$search_data;
			}
            echo $clients;

            $this->close_connection();
        }
		
		function add_property($type, $name, $price, $location, $status) {
			$this->open_connection();

            $insert_statement1 = $this->db_holder->prepare("INSERT INTO properties VALUES (null, ?, ?, ?, ?, ?);");
            $insert_statement1->execute(array($type, $name, $price, $location, $status));

            $this->close_connection();

		}
		
		function display_properties() {
			$this->open_connection();

            $select_statement = $this->db_holder->query("SELECT * FROM properties;");

            $prop = "<tr>
						<th>TYPE</th>
						<th>Title</th>
						<th>Price</th>
						<th>Location</th>
						<th>Status</th>
						<th>Action</th>
					</tr>";

            while($content = $select_statement->fetch()) {
                $prop .= "<tr id = 'prop_".$content[0]."' onclick = ''>
								<td>".$content[1]."</td>
								<td>".$content[2].", ".$content[2]."</td>
                                <td>".$content[3]."</td>
                                <td>".$content[4]."</td>
                                <td>".$content[5]."</td>
								<td><button onclick = 'updateProp(".$content[3].")' class = 'btn btn-small'>update</button></td>
                            </tr>";
            }

            echo $prop;

            $this->close_connection();
		}

        function retrieve_employees_data_to_update($id) {
            $this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT employee_id,
                                                                  lastname,
                                                                  firstname,
                                                                  gender,
                                                                  month(birthdate),
                                                                  day(birthdate),
                                                                  year(birthdate),
                                                                  address,
                                                                  contact_number,
                                                                  job_type
                                                           FROM employees
                                                           WHERE employee_id = ?;");
            $select_statement->execute(array($id));
            $content = $select_statement->fetch();
            if($content[9] == "cashier") {
                $select_statement2 = $this->db_holder->prepare("SELECT a.username
                                                                FROM accounts AS a,
                                                                     employees AS e
                                                                WHERE e.employee_id = a.employee_id AND
                                                                      e.employee_id = ?;");
                $select_statement2->execute(array($id));
                $username = $select_statement2->fetch();
                $data_array = array("employee_id"=>$content[0],
                                    "lastname"=>$content[1],
                                    "firstname"=>$content[2],
                                    "gender"=>$content[3],
                                    "birth_month"=>$content[4],
                                    "birth_date"=>$content[5],
                                    "birth_year"=>$content[6],
                                    "address"=>$content[7],
                                    "contact_number"=>$content[8],
                                    "type_of_job"=>$content[9],
                                    "username"=>$username[0]);
                $encoded_data = json_encode($data_array);
                echo $encoded_data;
            } else {
                $data_array = array("employee_id"=>$content[0],
                                    "lastname"=>$content[1],
                                    "firstname"=>$content[2],
                                    "gender"=>$content[3],
                                    "birth_month"=>$content[4],
                                    "birth_date"=>$content[5],
                                    "birth_year"=>$content[6],
                                    "address"=>$content[7],
                                    "contact_number"=>$content[8],
                                    "type_of_job"=>$content[9]);
                $encoded_data = json_encode($data_array);
                echo $encoded_data;
            }

            $this->close_connection();
        }

        function update_employees_data($id, $lastname, $firstname, $gender, $birthdate, $address, $contact_number, $job_type, $username, $password) {
            $this->open_connection();

            $update_statement = $this->db_holder->prepare("UPDATE employees
                                                              SET lastname = ?,
                                                                  firstname = ?,
                                                                  gender = ?,
                                                                  birthdate = ?,
                                                                  address = ?,
                                                                  contact_number = ?,
                                                                  job_type = ?
                                                              WHERE employee_id = ?;");
            $update_statement->execute(array($lastname, $firstname, $gender, $birthdate, $address, $contact_number, $job_type, $id));

            echo "php = ".$lastname;

            if($job_type == "cashier") {
                echo "php cashier = ".$username.$password.$id;
                $update_statement2 = $this->db_holder->prepare("UPDATE accounts
                                                                   SET username = ?,
                                                                       password = ?
                                                                   WHERE employee_id = ?;");
                $update_statement2->execute(array($username, $password, $id));
            }
            $this->close_connection();
        }

        function fire_employee($id, $date, $remarks) {
            $this->open_connection();

            $insert_statement = $this->db_holder->prepare("INSERT INTO fired_employees VALUES (?, ?, ?);");
            $insert_statement->execute(array($id, $date, $remarks));

            $this->close_connection();
        }

        function display_fired_employees() {
            $this->open_connection();

            $select_statement = $this->db_holder->query("SELECT e.*, f.date_fired, f.reason
                                                           FROM employees AS e, fired_employees AS f
                                                           WHERE e.employee_id = f.employee_id;");

            while($content = $select_statement->fetch()) {
                echo "<tr id = 'fired_employee_".$content[0]."'>
                        <td>".$content[1].", ".$content[2]."</td>
                        <td>
                            <table>
                                <tr><td>Gender: </td><td>".$content[3]."</td></tr>
                                <tr><td>Birthday: </td><td>".$content[4]."</td></tr>
                                <tr><td>Address: </td><td>".$content[5]."</td></tr>
                                <tr><td>Contact Number: </td><td>".$content[6]."</td></tr>
                                <tr><td>Job Type: </td><td>".$content[7]."</td></tr>
                            </table>
                        </td>
                        <td>".$content[8]."</td>
                        <td>".$content[9]."</td>
                      </tr>";
            }
            $this->close_connection();
        }

        function search_fired_employees($name_to_search) {
            $this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT e.*,
                                                            f.date_fired,
                                                            f.reason
                                                     FROM employees AS e,
                                                          fired_employees AS f
                                                     WHERE e.employee_id = f.employee_id AND
                                                           (e.firstname LIKE ? OR
                                                            e.lastname LIKE ?);");
            $select_statement->execute(array($name_to_search, $name_to_search));

            while($content = $select_statement->fetch()) {
                echo "<tr id = 'fired_employee_".$content[0]."'>
                        <td>".$content[1].", ".$content[2]."</td>
                        <td>
                            <table>
                                <tr><td>Gender: </td><td>".$content[3]."</td></tr>
                                <tr><td>Birthday: </td><td>".$content[4]."</td></tr>
                                <tr><td>Address: </td><td>".$content[5]."</td></tr>
                                <tr><td>Contact Number: </td><td>".$content[6]."</td></tr>
                                <tr><td>Job Type: </td><td>".$content[7]."</td></tr>
                            </table>
                        </td>
                        <td>".$content[8]."</td>
                        <td>".$content[9]."</td>
                      </tr>";
            }

            $this->close_connection();
        }

    } // ============= Class ends ===============