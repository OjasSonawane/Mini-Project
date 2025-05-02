<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile - Modern Eats</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  
 <link rel="stylesheet" href="../styles/userProfile.css">
    
</head>
<body>

<div class="profile-container">
  <h2>User Profile</h2>
  <form id="profile-form" action="http://localhost/modern-eats/user/updateProfile.php" method="POST">
    <div class="profile-field">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" disabled>
    </div>
    <div class="profile-field">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" disabled>
    </div>

    <!-- Toggle Button -->
<div class="profile-buttons">
  <button type="button" class="edit-btn" id="toggle-password-section">Change Password</button>
</div>


<div id="password-section" style="display: none;">
  <h3 style="margin-top: 30px;">Change Password</h3>
  <div class="profile-field">
    <label for="current-password">Current Password</label>
    <input type="password" id="current-password" placeholder="Enter current password">
  </div>
  <div class="profile-field">
    <label for="new-password">New Password</label>
    <input type="password" id="new-password" placeholder="Enter new password">
  </div>
  <div class="profile-field">
    <label for="confirm-password">Confirm New Password</label>
    <input type="password" id="confirm-password" placeholder="Confirm new password">
  </div>
  <div class="profile-buttons">
    <button type="button" class="save-btn" id="change-password-btn" style="background-color: #e67e22;">Change Password</button>
  </div>
</div>

    
    <div class="profile-buttons">
      <button type="button" class="edit-btn" id="edit-btn">Edit Profile</button>
      <button type="submit" class="save-btn" id="save-btn">Save Changes</button>
    </div>
  </form>
</div>

<script>
  const editBtn = document.getElementById('edit-btn');
  const saveBtn = document.getElementById('save-btn');
  const inputs = document.querySelectorAll('#profile-form input');

  editBtn.addEventListener('click', () => {
    inputs.forEach(input => input.disabled = false);
    editBtn.style.display = 'none';
    saveBtn.style.display = 'inline-block';
  });

  document.getElementById('profile-form').addEventListener('submit', function (e) {
    e.preventDefault();

  

  });
  document.getElementById('toggle-password-section').addEventListener('click', function () {
  const section = document.getElementById('password-section');
 
  section.style.display = section.style.display === 'none' ? 'block' : 'none';
  
});

</script>

</body>
</html>
