<?php

class User
{
	function __construct()
	{
		$hostname = "sql2.njit.edu";
		$username = "ne58";
		$password = "7ir1qWL9P";
		$conn = new PDO("mysql:host=$hostname;dbname=ne58",
		$username, $password);
		$this->connection = $conn;
		echo "Connected Successfully"."<br>"; 
	}

	function displayAll()
	{
		$sql = "select * from accounts";
		$results = $this->connection->query($sql);

		if(count($results) > 0)
		{
			echo "<table border=\"1\">
			<tr>
				<th>ID</th>
				<th>Email</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Phone</th>
				<th>Gender</th>
				<th>Birthday</th>
				<th>Password</th>
			</tr>";
			foreach ($results as $row) {
				echo "<tr>
						<td>".$row["id"]."</td>
						<td>".$row["email"]."</td>
						<td>".$row["fname"]."</td>
						<td>".$row["lname"]."</td>
						<td>".$row["phone"]."</td>
						<td>".$row["gender"]."</td>
						<td>".$row["birthday"]."</td>
						<td>".$row["password"]."</td>
					</tr>";
			}
			
		}
		else{
		    echo '0 results';
		}
	}

	function deleteUser($id)
	{	
		$this->id = $id;
		$sql = "delete from accounts where id = ".$this->id;
		$results = $this->connection->query($sql);
	}

	function addUser($email, $fname, $lname, $phone, $birthday, $gender, $password)
	{
		$sql = "insert into accounts (email, fname, lname, phone, birthday, gender, password) values ('$email', 
		'$fname', '$lname', '$phone', '$birthday', '$gender', '$password')";
		$results = $this->connection->query($sql);
	}

	function updateUser($id, $password)
	{
		$this->id = $id;
		$this->password = $password;
		$sql = "update accounts set password = ".$this->password." where id = ".$this->id;
		$results = $this->connection->query($sql);
	}

}

$user1 = new User;

$user1->deleteUser(9);

$user1->addUser('abc@gmail.com', 'Bob', 'Johnson', '123-6543-2314', '1989-10-5', 'male', 'bobspassword');

$user1->updateUser(11, '131518');

$user1->displayAll();

?>