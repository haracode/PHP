# PHP
<?php
$con = mysql_connect('[][]host[][]', '[][]dbname[][]', '[][]pass[][]');
if (!$con){
die("Connection Failed: ". mysql_error());
}

mysql_select_db("a4167621_assign4",$con);
$sql = "SELECT * FROM User";
$myData = mysql_query($sql,$con);
echo "The ID’s, first names, and last names of all users of the library ";
echo "<table border=1>
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
</tr>";

while($record = mysql_fetch_array($myData)){
echo "<tr>";
echo "<td>" . $record['id'] . "</td>";
echo "<td>" . $record['fname'] . "</td>";
echo "<td>" . $record['lname'] . "</td>";
echo "</tr>";
}
echo "</table>";

echo "<br/>";
echo "<br/>";

$query2 = "SELECT c.barcode, b.author, b.title FROM Circ c, Book b WHERE b.barcode IN (c.barcode)";
$result2 = mysql_query($query2);
echo "2) The barcodes, authors, and titles of all books that are in circulation (checked out) "."<br/>";
echo "SQL = SELECT c.barcode, b.author, b.title FROM Circ c, Book b WHERE b.barcode IN (c.barcode)";
echo "<table border=1>
<tr>
<th>Barcodes</th>
<th>Author</th>
<th>Titles</th>
</tr>";

while($row2 = mysql_fetch_array($result2)){  
echo "<tr><td>" . $row2['barcode'] . "</td><td>" . $row2['author'] . "</td><td>".$row2['title']."</td></tr>";  
}

echo "</table>";

echo "<br/>";
echo "<br/>";

$query3 = "SELECT DISTINCT c.id, u.lname FROM Circ c, User u WHERE u.id IN (c.id) ORDER By u.lname";
$result3 = mysql_query($query3);
echo "3) The ID’s and last names of all users of the library who have checked out books sorted by user’s last name"."<br/>";
echo "SQL = SELECT DISTINCT c.id, u.lname FROM Circ c, User u WHERE u.id IN (c.id) ORDER By u.lname";
echo "<table border=1>
<tr>
<th>ID</th>
<th>Last Name</th>
</tr>";

while($row3 = mysql_fetch_array($result3)){  
echo "<tr><td>" . $row3['id'] . "</td><td>" . $row3['lname'] . "</td></tr>";  
}

echo "</table>";

echo "<br/>";
echo "<br/>";

$query4 = "SELECT b.title, c.checkdate, c.duedate FROM Circ c, Book b WHERE b.barcode = c.barcode AND c.duedate < '20110402'";
$result4 = mysql_query($query4);
echo "4) The titles, check out dates, and due dates of all books due before 04/02/2011"."<br/>";
echo "SQL = SELECT b.title, c.checkdate, c.duedate FROM Circ c, Book b WHERE b.barcode = c.barcode AND c.duedate < '20110402'";
echo "<table border=1>
<tr>
<th>Title</th>
<th>CheckOut Date</th>
<th>Due Date</th>
</tr>";

while($row4 = mysql_fetch_array($result4)){  
echo "<tr><td>" . $row4['title'] . "</td><td>" . $row4['checkdate'] . "</td><td>".$row4['duedate']."</td></tr>";  
}

echo "</table>";

echo "<br/>";
echo "<br/>";

$query5 = "SELECT DISTINCT c.id, u.lname, author, title FROM User u, Circ c LEFT JOIN Book ON Book.barcode=c.barcode Where u.id = c.id";
$result5 = mysql_query($query5);
echo "5) The ID’s and last names of all users of the library who have checked out books together with authors’ names and titles of the books checked out by them. "."<br/>";
echo "SQL = SELECT DISTINCT c.id, u.lname, author, title FROM User u, Circ c LEFT JOIN Book ON Book.barcode=c.barcode Where u.id = c.id";
echo "<table border=1>
<tr>
<th>ID</th>
<th>Last Name</th>
<th>Author</th>
<th>Title</th>
</tr>";

while($row5 = mysql_fetch_array($result5)){  
echo "<tr><td>" . $row5['id'] . "</td><td>" . $row5['lname'] . "</td><td>".$row5['author']."</td><td>".$row5['title']."</td></tr>";  
}

echo "</table>";


//$query3 = SELECT DISTINCT c.id, u.lname FROM Circ c, User u WHERE u.id IN (c.id) ORDER By u.lname
//$query4 = SELECT b.title, c.checkdate, c.duedate FROM Circ c, Book b WHERE b.barcode = c.barcode AND c.duedate < '20110402'
//$query5 = SELECT DISTINCT c.id, u.lname, author, title FROM User u, Circ c LEFT JOIN Book ON Book.barcode=c.barcode Where u.id = c.id


mysql_close($con);
?>
