<!-- Modal Form -->
<div id="applicationForm" class="modal" style="display:none;">
    <div class="modal-content" 
     style="background:white; padding:20px; border-radius:10px; 
            width:600px; height:70vh; margin:50px auto; 
            position:relative; overflow-y:auto;">
    <span class="close" onclick="closeForm()" 
          style="position:absolute; top:10px; right:15px; font-size:25px; cursor:pointer;">&times;</span>
        <h2>Internship Application Form</h2>

        <form id="internForm">
            <label>Selected Position:</label>
            <input type="text" name="position" id="positionField" readonly style="width:100%; margin-bottom:10px;">

            <label>First Name:</label>
            <input type="text" name="first_name" required style="width:100%; margin-bottom:10px;">

            <label>Middle Name:</label>
            <input type="text" name="middle_name" style="width:100%; margin-bottom:10px;">

            <label>Last Name:</label>
            <input type="text" name="last_name" required style="width:100%; margin-bottom:10px;">

            <label>Gender:</label>
            <select name="gender" style="width:100%; margin-bottom:10px;">
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>

            <label>Age:</label>
            <input type="number" name="age" required style="width:100%; margin-bottom:10px;">

            <label>Email Address:</label>
            <input type="email" name="email" required style="width:100%; margin-bottom:10px;">

            <label>Student Number:</label>
            <input type="text" name="student_number" required style="width:100%; margin-bottom:10px;">

            <label>Phone Number:</label>
            <input type="text" name="phone_number" required style="width:100%; margin-bottom:10px;">

            <label>Course:</label>
            <input type="text" name="course" value="BSIT" readonly style="width:100%; margin-bottom:10px;">

            <label>Address:</label>
            <input type="text" name="address" required style="width:100%; margin-bottom:10px;">

            <button type="submit" class="submit-btn" style="background:#0b6623; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">Submit</button>
        </form>
    </div>
</div>



