<?php
include('security.php');

//If the user clicks the reg btn all details are checked
if(isset($_POST['reg_company']))
{
    $companyName = $_POST['companyName'];
    $companyType = $_POST['companyType'];
    $companyAddress = $_POST['companyAddress'];
    $vrnNumber = $_POST['vrnNumber'];
    $companytinNumber = $_POST['companytinNumber'];
    $companyEmail = $_POST['companyEmail'];
    $companyphoneNumber = $_POST['companyphoneNumber'];

    // Assuming that the user's email is stored in $_SESSION['userEmail']
    $userEmail = $_SESSION['userEmail'];

    // If the database is connected successfully, the following code will be executed
    if($conn)
    {
        // Insert the new company information into the database
        $sql = "INSERT INTO company (companyName, companyType, companyAddress, vrnNumber, companytinNumber, companyEmail, companyphoneNumber, userEmail)
                VALUES ('$companyName', '$companyType', '$companyAddress', '$vrnNumber', '$companytinNumber', '$companyEmail', '$companyphoneNumber', '$userEmail')";

        if (mysqli_query($conn, $sql)) 
        {   
            // Redirect to the dashboard
            header("Location: userDashboard.php");
            exit();
        } 
        else 
        {
            // Handle the error
            echo "Error creating new company: " . mysqli_error($conn);
        }
    }
    else
    {
        echo "No database connection.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Company registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Spartan", sans-serif;
        }

        /* Global Styles */
        body{
            width: 100%;
            display: flex;
            background-color: #f7f7f7;
        }

        h1{
            font-size: 35px;
            line-height: 64px;
            color: #222;
        }

        h2 {
            font-size: 46px;
            line-height: 54px;
            color: #222;
        }

        h4 {
            font-size: 20px;
            /* line-height: 64px; */
            color: #222;
        }

        h6 {
            font-size: 12px;
            font-weight: 700;
        }

        p{
            font-size: 16px;
            color: #465b52;
            margin: 15px 0 20px 0;
        }

        .section-pl{
            padding: 40px 80px;
        }

        .section-ml{
            margin: 40px 0;
        }

        .sidebar {
            width: fit-content;
            background-color: #008080; /* Teal color */
            color: #ffffff; /* Text color */
            height: 100vh;
            overflow-y:auto;

        }

        .sidebar {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar hr
        {
            margin-top: 20px;
            opacity: 30%;
        }
        .sidebar .item{
            line-height: 40px;
        }
        
        .sidebar .menu .sub-btn {
            padding: 10px;
        }

        .sidebar  a {
            color: #ffffff; /* Link color */
            text-decoration: none;
            cursor: pointer;
        }  

        .sidebar a:hover {
            opacity: 80%;
        }

        .menu{
            width: fit-content;
        }

        .sub-menu{
            line-height: 10px;
            background: #008080;
            display: none;
            padding-left: 10px;
            font-size: smaller;

        }
        .sub-menu a{
            font-size: smaller;
            text-decoration: none;
            color:#fff;
            display: list-item;
            padding: 10px;

        }
        .sub-menu a:hover{
            opacity: 80%;
        }

        .rotate{
            transform: rotate(90deg);
        }

        .item a .dropdown{
            color: #fff;
            margin: 5px;
            transition: 0.3s ease;
        }
        h1 {
        text-align: center;
        }
        .addcontainer {
        max-width: 500px;
        margin: 0 auto;
        margin-left: 50px;
        }
        
        .form-group {
        margin-bottom: 10px;
        }
        
        .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        }
        
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="email"],
        .form-group select {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
                
        .form-group select {
        height: 36px;
        }
        
        .form-group input[type="submit"] {
        background-color: #008080;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        }
        
        .form-group input[type="submit"]:hover {
        background-color: #45a049;
        }
        /*Sidebar Logo*/
        .sidebar .menu .item .logo img
        {
        width: 180px;
        height: fit-content;
        margin-left: 20px;
        margin-top: 20px;   
        }

        .companyInfoContainer {
            max-width: 500px;
        }

        .companyInfoContainer .heading .box{
            color: black;
            background-color:rgb(231, 231, 231);
            font-size: 15px;
            margin-right: 6px;
            display:inline-block;
            padding:4px;
            width:fit-content;
            height: 30px; /* Adjust the height as needed */
            text-align: center; /* Center the link content */
            line-height: 30px; /* Vertically center the link content */
            text-decoration: none; /* Remove underline */
            box-shadow: 0.5px 0.5px 0.5px #008080 ; /* Add box shadow */
        }

        .companyInfoContainer .heading .box:hover{
            opacity: 70%;
        }

        .addcontainer{
            display: none;
            margin-top:5px;
        }

        form
        {
            margin-top:15px;
        }
        
        .actionBtn
        {
            display:flex;
            gap:10px;
        }


        /*table starts here*/
        table 
        {
            border-collapse: collapse;
            margin-top:15px;
        }
        .companyTable{
            margin-top:5px;
            margin-left: 50px;
        }

        th, td {
            box-shadow: 0.5px 0.5px 3px 0.5px #c9c9c9 ; /* Add box shadow */
            padding: 10px;
            text-align: center;
        }
        
        th {
            background-color: #efefef;
        }

        .last-cell {
            border-right: 1px solid black;
        }

        td i{
            margin: 5px;
            cursor: pointer;
        }
        td i:hover{
            opacity: 40%;
        }

        button{
            text-align:center;
            padding-top: 5px;
        }

        #downbtn{
            margin-left: -70px;
            margin-top: 10px;
        }

        #heading{
            margin-top: 4px;

        }


    </style>
</head>
<body>
    <!--sidebar starts here-->   
    <section class="header">
        <div class="sidebar">
            <div class="menu">
                <div class="item">
                    <a href="userDashboard.php" class="logo"><img src="assets/img/logo.png" alt=""></a>
                </div>
                <hr>
                <div class="item">
                    <a class="sub-btn">SETTINGS<i class="fas fa-caret-right dropdown" style="margin-left: 100px;"></i></a>
                    <div class="sub-menu">
                        <a href="companyInfo.php" class="sub-item">Company Information</a>
                        <a href="userInfo.php" class="sub-item">User Information</a>
                    </div>
                </div>  
                <div class="item">
                    <a class="sub-btn">EMPLOYEE<i class="fas fa-caret-right dropdown" style="margin-left: 93px;"></i></a>
                    <div class="sub-menu">
                        <a href="p-employee.html" class="sub-item">Primary Employees</a>
                        <a href="c-employee.html" class="sub-item">Secondary Employees</a>
                    </div>
                </div>
                <div class="item">
                    <a class="sub-btn">PAYROLL<i class="fas fa-caret-right dropdown"style="margin-left: 109px;"></i></a>
                    <div class="sub-menu">
                        <a href="allowances.html" class="sub-item">Allowance</a>
                        <a href="deductions.html" class="sub-item">Deductions</a>
                        <a href="payrollsetup.html" class="sub-item">Payroll setup</a>
                        <a href="payeecalculator.html" class="sub-item">PAYE calculator.</a>
                        <a href="https://taxpayerportal.tra.go.tz" class="sub-item">TAX Portal.</a>
                    </div>
                </div>
                <div class="item">
                    <a class="sub-btn">REPORTS<i class="fas fa-caret-right dropdown"style="margin-left: 109px;"></i></a>
                    <div class="sub-menu">
                    <a href="" class="sub-item">Summary Reports</a>
                    <a href="" class="sub-item">Detailed Reports</a>
                    </div>
                </div>
                <div class="item">
                    <a class="sub-btn" style="margin-left: 10px;"> <i class="fas fa-user"></i></a>
                    <div class="sub-menu">
                    <a href="" class="sub-item">Change Password.</a>
                    <a href="" class="sub-item" id="logout-link">Log Out.</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="companyInfoContainer" id="companyInfoContainer">
            <div class="companyTable" id="companyTable">
                <h1>List Of Companies</h1>
                <div class="heading" id="heading">
                    <a href="" class="box" id="companylistbtn">List<i class="fas fa-list-alt"></i></a>
                    <a href="" class="box" id="addCompanybtn">Add Company<i class="fas fa-plus"></i></a>
                    <a href=""class="box">Print <i class="fas fa-print"></i></a>
                    <a href=""class="box">Excel <i class="fas fa-file-excel"></i></a>
                </div>
                <table>
                    <thead>
                        <tr>
                        <th><input type="checkbox" name="selectall" id="selectall"></th>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>VRN</th>
                        <th>TIN Number</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="companyTableBody">
                    </tbody>
                </table>
                <div class="downbtn" id="downbtn" style="margin-left: 1px;">
                    <button id="delete" style="width: 90px;height: 25px;">Delete</button>
                    <button id="fastback" style="margin-left: 4px;width: 30px;"><i class="fas fa-fast-backward"></i></button>
                    <button id="back" style="margin-left: 4px;width: 20px;"><i class="fas fa-caret-left dropdown"></i></button>
                    <button id="foward" style="margin-left: 4px;width: 20px;"><i class="fas fa-caret-right dropdown"></i></button>
                    <button id="fastfoward" style="margin-left: 4px;width: 30px;"><i class="fas fa-fast-forward"></i></button>
                </div>
            </div>



            <div class="addcontainer" id="addcontainer">
                <h1>Add Company</h1>
                <div class="heading" id="heading">
                    <a href="" class="box" id="companylistbtn">List<i class="fas fa-list-alt"></i></a>
                    <a href="" class="box" id="addCompanybtn">Add Company<i class="fas fa-plus"></i></a>
                    <a href=""class="box">Print <i class="fas fa-print"></i></a>
                    <a href=""class="box">Excel <i class="fas fa-file-excel"></i></a>
                </div>

                <form action="" method="post" onsubmit="return validate();">
                    <div class="form-group">
                        <label for="name">Company Name:</label>
                        <input type="text" id="companyName" name="companyName">
                    </div>
                    <div class="form-group">
                        <label for="name">Company Type:</label>
                        <input type="text" id="companyType" name="companyType">
                    </div>
                    <div class="form-group">
                        <label for="location">Company Address:</label>
                        <input type="text" id="companyAddress" name="companyAddress">
                    </div>
                    <div class="form-group">
                        <label for="vrnNumber">VRN:</label>
                        <input type="text" id="vrnNumber" name="vrnNumber">
                    </div>
                    <div class="form-group">
                        <label for="tinNumber">Tin Number:</label>
                        <input type="number" id="companytinNumber" name="companytinNumber">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" id="companyEmail" name="companyEmail">
                    </div>
                    <div class="form-group">
                        <label for="Phone number">Phone Number:</label>
                        <input type="number" id="companyphoneNumber" name="companyphoneNumber">
                    </div>
                    <div class="actionBtn" id="actionBtn">
                        <div class="form-group">
                            <input type="submit" value="Submit" name="reg_company" id="reg_company">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="back" id="backbtn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        //dropdown effect in the sidebar
        $(document).ready(function() {
            $('.sub-btn').click(function(){
                $(this).next('.sub-menu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');
            });

            //switch from personal details and earning and deductions.
            const addCompanybtn = document.getElementById("addCompanybtn");
            const companyTable = document.getElementById("companyTable");
            const companylistbtn = document.getElementById("companylistbtn");
            const addcontainer = document.getElementById("addcontainer");

            addCompanybtn.addEventListener("click", (event) => {
            event.preventDefault();
            companyTable.style.display = "none";
            addcontainer.style.display = "block";
            });

            companylistbtn.addEventListener("click", (event) => {
            event.preventDefault();
            addcontainer.style.display = "none";
            companyTable.style.display = "block";
            });
        
        });
        
        //back button functionality
        var backbtn = document.getElementById('backbtn')
        backbtn.addEventListener("click", goBack);

        function goBack(){
            window.location.href="companyInfo.html";
        }
        //Data validation
        //when the reg form is clicked
        function validate() {
        var companyName = document.getElementById("companyName").value;
        var companyType = document.getElementById("companyType").value;
        var companyAddress = document.getElementById("companyAddress").value;
        var vrnNumber = document.getElementById("vrnNumber").value;
        var companytinNumber = document.getElementById("companytinNumber").value;
        var companyEmail = document.getElementById("companyEmail").value;
        var companyphoneNumber = document.getElementById("companyphoneNumber").value;

        if (companyName == null || companyName.trim() === "") {
        Toastify({
        text: "Company name is required.",
        duration: 3000,
        backgroundColor: "#000000",
        }).showToast();
        return false;
        }

        if (companyType == null || companyType.trim() === "") {
            Toastify({
                text: "Company Type is required.",
                duration: 3000,               
                backgroundColor: "#000000",
            }).showToast();
            return false;
        }

        if (companyAddress == null || companyAddress.trim() === "") {
            Toastify({
                text: "Company Address is required.",
                duration: 3000,               
                backgroundColor: "#000000",
            }).showToast();
            return false;
        }

        if (vrnNumber == null || vrnNumber.trim() === "") {
            Toastify({
                text: "VRN Number is required.",
                duration: 3000,               
                backgroundColor: "#000000",
            }).showToast();
            return false;
        }
        // Validate company VRN
        if (!vrnNumber.match(/^\d{13}[a-zA-Z]$/)) {
        Toastify({
            text: "VRN must have 13 digits and end with a letter.",
            duration: 3000,          
            backgroundColor: "#000000",
        }).showToast();
        return false;
        }

        if (companytinNumber == null || companytinNumber.trim() === "") {
            Toastify({
                text: "TIN Number is required.",
                duration: 3000,              
                backgroundColor: "#000000",
            }).showToast();
            return false;
        }
        if (!companytinNumber.match(/^\d{9}$/)) {
            Toastify({
                text: "TIN number must have nine digits.",
                duration: 3000,              
                backgroundColor: "#000000",
            }).showToast();
            return false;
        }

        if (companyEmail == null || companyEmail.trim() === "") {
            Toastify({
                text: "Company Email is required.",
                duration: 3000,                
                backgroundColor: "#000000",
            }).showToast();
            return false;
        }
        // Validate company email
        if (!/.+@.+\..+/.test(companyEmail)) {
        Toastify({
            text: "Invalid Email Address.",
            duration: 3000,           
            backgroundColor: "#000000",
        }).showToast();
        return false;
        }

        if (companyphoneNumber == null || companyphoneNumber.trim() === "") {
            Toastify({
                text: "Company Phone Number is required.",
                duration: 3000,
                backgroundColor: "#000000",
            }).showToast();
            return false;
        }

        if (!companyphoneNumber.match(/^0\d{9}$/)) {
            Toastify({
            text: "The phone number should start with 0 followed by nine digits.",
            duration: 3000,
            backgroundColor: "#000000",
            }).showToast();
            return false;
        }





        return true;
    }
    </script>
</body>
</html>