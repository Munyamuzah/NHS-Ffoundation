<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Neuromodulation Form</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center fw-bolder">Neuromodulation</h2>
        <form id="painForm">
        <div class="card border-dark">
            <div class="card-header bg-dark fw-bolder text-white">Patient Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="surname">Surname:</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" class="form-control" id="dob" name="dob" max=<?php echo date('Y-m-d')?> required>
                        </div>
                        <div class="col-md-6">
                            <label for="age">Age:</label>
                            <input type="text" class="form-control" id="age" name="age" readonly>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-dark mt-3">
                <div class="card-header bg-dark fw-bolder text-white">Brief Pain Inventory (BPI)</div>
                <div class="card-body" id="questions">                   
                </div>
            </div>
            <div class="card border-dark mt-3">
                <div class="card-header bg-dark fw-bolder text-white">Total Score</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="totalScore">Total Score:</label>
                        <input type="text" class="form-control" id="totalScore" name="totalScore" readonly>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#dob').on('change', function() {
                let dob = new Date($(this).val());
                let age = new Date().getFullYear() - dob.getFullYear();
                $('#age').val(age);
            });

            $('.max-ten').on('blur',function(){
                let entered_score = $(this).val();
                if(entered_score>10 || entered_score<0){
                    alert('The score range must be between 0-10, Kindly correct that');
                    $(this).val('0');
                }
            })

            $.ajax({
                url: 'database/functions.php?action=getQuestions',
                method: 'GET',
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    var questions = response;
            var questions_pocket = $("#questions");
            
            questions_pocket.empty(); // Clear any existing rows
            for (var i = 0; i < questions.length; i++) {
                var question = `
                <div class="row form-group mb-1">
                            <div class="col-md-10"> <label for="q${i} ?>">Question ${i} ?>: ${response.q_details} </label> </div>
                            <div class="col-md-2"> <input type="number" class="form-control max-ten text-center" placeholder="1-10" id="q${i}" name="q${i}" min="0" max="${response.q_highest_mark}" required> </div>
                        </div> 
                `;
                questions_pocket.append(question);
                }
            }
            });

            $('#painForm input[type=number]').on('input', function() {
                let totalScore = 0;
                $('.max-ten').each(function() {
                    let value = $(this).val();
                    if (!isNaN(value) && value.length !== 0) {
                        totalScore += parseFloat(value);
                    }
                });
                $('#totalScore').val(totalScore);
            });

            $('#painForm').on('submit', function(event) {
                event.preventDefault();
                // send form by ajax for saving
                $.ajax({
                    url: 'database/functions.php?action=addPatient', 
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Form submitted successfully!');
                        $('.form-control').val('');
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while submitting the form.');
                        console.log(xhr.responseText);
                    }
                });
            });
    
           
        });


    </script>
</body>
</html>
