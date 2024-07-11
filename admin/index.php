<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin View</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Admin View</h2>
        <table class="table table-hover table-striped" id="patientTable">
            <thead >
                <tr >
                    <th class="bg-dark text-white">Date of Submission</th>
                    <th class="bg-dark text-white">First Name</th>
                    <th class="bg-dark text-white">Surname</th>
                    <th class="bg-dark text-white">Age</th>
                    <th class="bg-dark text-white">Date of Birth</th>
                    <th class="bg-dark text-white">Total Score</th>
                </tr>
            </thead>
            <tbody >
                <!-- Data goes here -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../database/functions.php?action=getPatients',
                method: 'GET',
                dataType: "JSON",
                success: function(response) {
                    var patients = response;
            var tbody = $("#patientTable tbody");
            
            tbody.empty(); // Clear any existing rows
            for (var i = 0; i < patients.length; i++) {
                var dob = new Date(patients[i].patient_dob);
                var formattedDob = dob.getFullYear() + '-' + 
                                   ('0' + (dob.getMonth() + 1)).slice(-2) + '-' + 
                                   ('0' + dob.getDate()).slice(-2);
                var row = "<tr class='view'>";
                row += "<td>" + patients[i].patient_submission_date + "</td>";
                row += "<td>" + patients[i].patient_fname + "</td>";
                row += "<td>" + patients[i].patient_sname + "</td>";
                row += "<td>" + patients[i].patient_age + "</td>";
                row += "<td>" + formattedDob + "</td>";
                row += "<td>" + patients[i].patient_score + "</td>";
                row += "</tr>";
                tbody.append(row);
                    // $('#patientTable').html(data);
                }
            }
            });
        });
    </script>
</body>
</html>
