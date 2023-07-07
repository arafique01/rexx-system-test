<!DOCTYPE html>
<html>

<head>
    <title>RXX System Code Test</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h2>RXX System Code Test</h2>

    <form action="index.php" method="POST">
        <input type="text" id="employeeName" name="employeeName" placeholder="Employee Name" />
        <select id="eventName" name="eventName">
            <option value="">All</option>
            <option value="PHP 7 crash course">PHP 7 crash course</option>
            <option value="International PHP Conference">International PHP Conference</option>
            <option value="code.talks">code.talks</option>
        </select>
        <input type="date" id="date" name="date"  />
        <button type="submit" value="Submit">
    </form>

    <table id="dataTable"><thead>
        <th>Participation Id</th>
        <th>Employee Name</th>
        <th>Employee Mail</th>
        <th>Event Id</th>
        <th>Event Name</th>
        <th>Participation Fee</th>
        <th>Event Date</th>
    </thead>
    <tbody>

        <?php foreach($result as $data){?>
        <tr>
        <td><?php echo $data['id'];?></td>
        <td><?php echo $data['name'];?></td>
        <td><?php echo $data['email'];?></td>
        <td><?php echo $data['event_id'];?></td>
        <td><?php echo $data['event_name'];?></td>
        <td><?php echo $data['participation_fee'];?></td>
        <td><?php echo $data['event_date'];?></td>
        
        </tr>
        <?php }?> 
    </tbody>
    </table>

</body>

</html>