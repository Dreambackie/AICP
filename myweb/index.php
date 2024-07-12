<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <form id = "registrationForm" action="index2.php" method="POST">
            <h2><u>Re</u>gistration</h2>
            <h3>Personal Details<br></h3>
            <div class="section">
                <label for="fullName">Full Name</label><br>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your name">
                <br>

                <label for="mobileNumber">Mobile Number</label><br>
                <input type="text" id="mobileNumber" name="mobileNumber" placeholder="Enter mobile number">
                <br>

                <label for="dob">Date of Birth</label><br>
                <input type="date" id="dob" name="dob" placeholder="Enter birth date">
                <br>

                <label for="gender">Gender</label><br>
                <input type="text" id="gender" name="gender" placeholder="Enter your gender">
                <br>

                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <br>
                

                <label for="occupation">Occupation</label><br>
                <input type="text" id="occupation" name="occupation" placeholder="Enter occupation">
            </div>
            <h3>Identity Details<br></h3>
            <div class="section">
                
                <label for="idType">ID Type</label><br>
                <input type="text" id="idType" name="idType" placeholder="Enter ID type"><br>

                <label for="issueDate">Issue Date</label><br>
                <input type="date" id="issueDate" name="issueDate" placeholder="Enter issue date"><br>

                <label for="idNumber">ID Number</label><br>
                <input type="text" id="idNumber" name="idNumber" placeholder="Enter ID number"><br>

                <label for="issueState">Issue State</label><br>
                <input type="text" id="issueState" name="issueState" placeholder="Enter issue state"><br>

                <label for="issueAuthority">Issue Authority</label><br>
                <input type="text" id="issueAuthority" name="issueAuthority" placeholder="Enter issue department"><br>


                <label for="expiryDate">Expiry Date</label><br>
                <input type="date" id="expiryDate" name="expiryDate" placeholder="Enter expiry date"><br>
            </div>

            <button type="submit">Next</button>
        </form>
    </div>

    <script>
        
document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let isValid = true;
    const fields = ['fullName', 'dob', 'email', 'mobileNumber', 'gender', 'occupation', 'idType', 'idNumber', 'issueAuthority', 'issueDate', 'issueState', 'expiryDate'];

    fields.forEach(function(field) {
        const value = document.getElementById(field).value.trim();
        if (value === '') {
            isValid = false;
            document.getElementById(field).style.borderColor = 'red';
        } else {
            document.getElementById(field).style.borderColor = '#ccc';
        }
    });

    if (isValid) {
        this.submit();
    } else {
        alert('Please fill out all fields.');
    }
});


    </script>

</body>
</html>


