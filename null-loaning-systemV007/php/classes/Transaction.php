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

        function add_client($last_name, $first_name, $address, $contact, $email, $job, $income, $prop_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $due_date, $remarks) {
            $this->open_connection();

            $insert_statement1 = $this->db_holder->prepare("INSERT INTO clients VALUES (null, ?, ?, ?, ?, ?, ?, ?);");
            $insert_statement1->execute(array($last_name, $first_name, $address, $contact, $email, $job, $income));

            $client_id = $this->db_holder->lastInsertId();

			//$this->add_transaction($client_id, $prop_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $due_date, $remarks);
			//$this->generate_client_account($last_name, $contact);

            $this->close_connection();
            return $client_id;
        }

        function add_transaction($client_id, $prop_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $date_due, $remarks) {
            $this->open_connection();

            $insert_statement = $this->db_holder->prepare("INSERT INTO transactions VALUES (null, ?, ?, (SELECT SysDate()), ?, ?, ?, ?, ?, ?);");
            $insert_statement->execute(array($client_id, $prop_id, $amount, $balance, $collateral, $mode_of_payment, $date_due, $remarks));

            $this->close_connection();
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
                $clients .= "<tr  id = 'client_".$content[0]."' ondblclick = 'show_action_options(".$content[0].")'>
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
		
		function get_client($client_id) {
			$this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT * FROM clients WHERE client_id = ?;");
			$select_statement->execute(array($client_id));

            $clients = "<table class = 'table'><tr>
						<th>Name</th>
						<th>Address</th>
						<th>Contact</th>
						<th>Email</th>
						<th>Job</th>
						<th>Income(approx.)</th>
					</tr>";
			
            while($content = $select_statement->fetch()) {
                $clients .= "<tr  id = 'client_".$content[0]."'>
                                            <td>".$content[1].", ".$content[2]."</td>
                                            <td>".$content[3]."</td>
                                            <td>".$content[4]."</td>
                                            <td>".$content[5]."</td>
                                            <td>".$content[6]."</td>
                                            <td>".$content[7]."</td>
                                       </tr>";
            }

            echo $clients."</table><br /><button class = 'btn btn-warning' onclick='updateClient(".$client_id.")'>update</button>
										 <button class = 'btn btn-danger' onclick = 'deleteClient(".$client_id.")'>delete</button>
										 <button class = 'btn' onclick = 'closeClientAction()'>close</button>";

            $this->close_connection();
		}
		
		function update_client($client_id, $last_name, $first_name, $address, $contact, $email, $job, $income) {
			$this->open_connection();
			
			$update_statement = $this->db_holder->prepare("UPDATE clients SET lastname = ?, firstname = ?, address = ?, contact = ?, email = ?, job = ?, income = ? WHERE client_id = ?;");
			$update_statement->execute(array($last_name, $first_name, $address, $contact, $email, $job, $income, $client_id));
			
			$this->close_connection();
		}
		
		function delete_client($client_id) {
			$this->open_connection();

            $select_statement = $this->db_holder->prepare("DELETE FROM clients WHERE client_id = ?;");
			$select_statement->execute(array($client_id));
			
			if($this->client_exist($client_id)) echo "Client has|had transaction records.\nFailed to delete client.";
			else echo "Client successfully deleted!";
			
            $this->close_connection();
		}
		
		function client_exist($client_id) {
			$select_statement = $this->db_holder->prepare("SELECT * FROM clients WHERE client_id = ?;");
			$select_statement->execute(array($client_id));
			if($select_statement->fetch()) {
				return true;
			}
			
			return false;
		}

		function generate_client_account($client_id, $last_name, $contact) {
			$this->open_connection();
			
			$insert_statement = $this->db_holder->prepare("INSERT INTO system_accounts VALUES (null, ?, ?, ?, ?);");
			$insert_statement->execute(array($client_id, "NULL".$last_name, $contact, "client"));
			
			$this->close_connection();
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
						<th>Due Date</th>
						<th>Action</th>
					</tr>";

            while($content = $select_statement->fetch()) {
                $trans .= "<tr id = 'clientTrans_".$content[0]."'>
								<td>".$content[6]."</td>
								<td>".$content[1].", ".$content[2]."</td>
                                <td>".$content[7]."</td>
                                <td>".$content[8]."</td>
                                <td>".$content[9]."</td>
                                 <td>".$content[11]."</td>
                                 <td><button onclick = 'updateBalance(".$content[3].")' class = 'btn btn-small'>update</button></td>
                            </tr>";
            }

            echo $trans;

            $this->close_connection();
		}
		
		function update_balance($trans_id, $amount) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT balance FROM transactions WHERE trans_id = ?;");
			$select_statement->execute(array($trans_id));
			$balance;
			while($content = $select_statement->fetch()) {
				$balance = $content[0];
			}
			
			$update_statement = $this->db_holder->prepare("UPDATE transactions set balance = ? WHERE trans_id = ?;");
			$update_statement->execute(array($balance-$amount, $trans_id));
			
			$close_connection();
		}
		
		function display_property_options($type) {
			$this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT prop_id, name FROM properties WHERE type = ?;");
			$select_statement->execute(array($type));
            $data = "<select id = 'propertyOptions' onchange = 'getPropertyPrice()'>";

            while($content = $select_statement->fetch()) {
                $data .= "<option value = '".$content[0]."'>".$content[1]."</option>";
            }

            echo $data;

            $this->close_connection();
		}
		
		function getPropertyPrice($prop_id) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT price FROM properties WHERE prop_id = ?;");
			$select_statement->execute(array($prop_id));
			
			$price = "N/A";
			
			while($content = $select_statement->fetch()) {
				$price = $content[0];
			}
			
			echo $price;
			
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
                $clients .= "<tr title = 'double click to show actions' id = 'client_".$content[0]."' ondblclick = 'show_action_options(".$content[0].")'>
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
		
		function update_property($propId, $type, $name, $price, $location) {
			$this->open_connection();

            $update_statement = $this->db_holder->prepare("UPDATE properties SET type = ?, name = ?, price = ?, location = ? WHERE prop_id = ?;");
            $update_statement->execute(array($type, $name, $price, $location, $propId));
			echo "this- ".$propId;
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
								<td>".$content[2]."</td>
                                <td>".$content[3]."</td>
                                <td>".$content[4]."</td>
                                <td>".$content[5]."</td>
								<td><button onclick = 'updateProp(".$content[0].")' class = 'btn btn-small'>update</button>
									<button onclick = 'deleteProp(".$content[0].")' class = 'btn btn-small'>delete</button>
								</td>
                            </tr>";
            }

            echo $prop;

            $this->close_connection();
		}

		function delete_property($propId) {
            $this->open_connection();

            $insert_statement = $this->db_holder->prepare("DELETE FROM properties WHERE prop_id = ?;");
            $insert_statement->execute(array($propId));

            $this->close_connection();
        }
		
		
        function retrieve_client_data($client_id) {
            $this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT * FROM clients WHERE client_id = ?;");
            $select_statement->execute(array($client_id));
            $content = $select_statement->fetch();
			$data_array = array("lastname"=>$content[1],
								"firstname"=>$content[2],
								"address"=>$content[3],
								"contact"=>$content[4],
								"email"=>$content[5],
								"job"=>$content[6],
								"income"=>$content[7]);
			$encoded_data = json_encode($data_array);
			echo $encoded_data;

            $this->close_connection();
        }
		
		function retrieve_property_data($propId) {
            $this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT * FROM properties WHERE prop_id = ?;");
            $select_statement->execute(array($propId));
			
            $content = $select_statement->fetch();
			
			$data_array = array("type"=>$content[1],
								"name"=>$content[2],
								"price"=>$content[3],
								"location"=>$content[4]);
			$encoded_data = json_encode($data_array);
			echo $encoded_data;

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