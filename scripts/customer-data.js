   // Load user data on page load
    window.addEventListener('DOMContentLoaded', function() {
      loadUserData();
    });

    function loadUserData() {
      fetch('/backend/customer-datab.php', {
        method: 'GET'
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          const userData = data.data;
          
          // Populate form fields
          document.getElementById('first_name').value = userData.first_name || '';
          document.getElementById('last_name').value = userData.last_name || '';
          document.getElementById('date_of_birth').value = userData.date_of_birth || '';
          document.getElementById('city').value = userData.city || '';
          document.getElementById('phone').value = userData.phone || '';
          document.getElementById('address').value = userData.address || '';
          
          // Set gender radio button
          if (userData.gender === 'Male') {
            document.getElementById('gender-male').checked = true;
          } else if (userData.gender === 'Female') {
            document.getElementById('gender-female').checked = true;
          }
          
          // Update profile picture if exists
          if (userData.profile_picture) {
            document.getElementById('profile-pic-preview').src = '/uploads/profiles/' + userData.profile_picture;
          }
        }
      })
      .catch(error => {
        console.error('Error loading user data:', error);
      });
    }

    // Handle form submission
    document.getElementById('profile-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData();
      formData.append('action', 'update_profile');
      formData.append('first_name', document.getElementById('first_name').value);
      formData.append('last_name', document.getElementById('last_name').value);
      formData.append('gender', document.querySelector('input[name="gender"]:checked')?.value || '');
      formData.append('date_of_birth', document.getElementById('date_of_birth').value);
      formData.append('city', document.getElementById('city').value);
      formData.append('phone', document.getElementById('phone').value);
      formData.append('address', document.getElementById('address').value);
      
      fetch('/backend/customer-datab.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          alert('Profile updated successfully!');
          loadUserData(); // Reload data
        } else {
          alert('Error: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating profile');
      });
    });