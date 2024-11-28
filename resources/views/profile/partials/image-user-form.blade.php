<section>
    <header>
        <h2 class="h4 text-dark">
            {{ __('Profile Image') }}
        </h2>
        <p class="text-muted">
            {{ __("Update your profile picture.") }}
        </p>
    </header>

    <div class="row justify-content-center">
        <!-- Profile Image Section -->
        <div class="col-12 col-md-6 text-center d-flex justify-content-center align-items-center mb-4">
            <div class="d-inline-block justify-content-center">
                @if(auth()->user()->profile_image)
                    <img id="currentImage" src="{{ auth()->user()->profile_image }}" class="img-fluid rounded-circle profile-image" alt="Current Profile" style="max-width: 200px;">
                @else
                    <img id="currentImage" src="{{ asset('assets/img/default.png') }}" class="img-fluid rounded-circle profile-image" alt="Current Profile" style="max-width: 200px;">
                @endif
            </div>

            <div class="mx-3" id="arrow" style="display: none;">
                <i class="fas fa-arrow-right fa-2x"></i>
            </div>

            <div class="d-inline-block">
                <img id="newImagePreview" src="{{ asset('assets/img/default.png') }}" class="img-fluid rounded-circle profile-image" alt="New Profile" style="max-width: 200px; display: none;">
            </div>
        </div>

        <!-- Form Section -->
        <div class="col-12">
            <form id="profileForm" method="post" action="{{ route('profile.update.image') }}" enctype="multipart/form-data" class="w-100 text-center">
                @csrf
                @method('patch')

                <div class="mb-3 d-flex flex-column flex-md-row justify-content-center align-items-center">
                    <!-- Upload Button -->
                    <label for="profile_image" class="btn btn-primary edit-image-btn mb-2 mb-md-0 me-md-3">
                        <i class="fas fa-upload"></i> {{ __('Upload') }}
                    </label>
                    <input type="file" id="profile_image" name="profile_image" class="form-control-file d-none" onchange="previewImage(event)">

                    <!-- Webcam Button -->
                    <button type="button" class="btn btn-secondary me-md-3 mb-2 mb-md-0" onclick="startWebcam()">
                        <i class="fas fa-video"></i> {{ __('Camera') }}
                    </button>

                    <!-- Save Button -->
                    <button id="btn" class="btn btn-primary profile-button me-md-3 mb-2 mb-md-0" type="submit" disabled>
    <i class="fas fa-save"></i> {{ __('Save') }}
</button>

                </div>
            </form>

            <!-- Webcam Capture Section -->
            <div class="mb-3 d-flex flex-column flex-md-row justify-content-center align-items-center">
                <video id="webcam" class="mb-2 mb-md-0" style="display:none; max-width: 100%; width: 200px; height: 200px;" autoplay></video>
                <canvas id="canvas" style="display:none;"></canvas>

                <div class="d-flex flex-column align-items-center ms-md-3 mt-4">
                    <button id="capture" style="display:none;" class="btn btn-success mb-2" onclick="captureImage()">
                        <i class="fas fa-camera"></i>{{ __(' Capture') }}
                    </button>

                    <button id="cancel" style="display:none;" class="btn btn-danger" onclick="cancelCapture()">
                        <i class="fas fa-times"></i>{{ __(' Cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var img = document.getElementById('newImagePreview');
            img.src = reader.result;
            img.style.display = 'block';
            document.getElementById('arrow').style.display = 'block';
            document.getElementById('btn').disabled = false;
        };
        reader.readAsDataURL(input.files[0]);
    }

    function captureImage() {
        const webcam = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        canvas.width = 200; // Match the size of the displayed images
        canvas.height = 200;
        context.drawImage(webcam, 0, 0, canvas.width, canvas.height);

        const imgData = canvas.toDataURL('image/png');
        document.getElementById('newImagePreview').src = imgData; // Display captured image
        document.getElementById('newImagePreview').style.display = 'block';
        document.getElementById('arrow').style.display = 'block'; // Show the arrow

        // Convert data URL to Blob
        canvas.toBlob(function(blob) {
            const formData = new FormData(document.getElementById('profileForm'));
            formData.append('profile_image', blob, 'profile_image.png');

            // Submit the form with the captured image
            fetch('{{ route('profile.update.image') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      window.location.reload();
                  } else {
                      alert('An error occurred while updating the profile image.');
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
              });
        }, 'image/png');
    }

    let webcamStream; 

    function startWebcam() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                webcamStream = stream; // Store the stream
                const webcam = document.getElementById('webcam');
                webcam.style.display = 'block'; // Show webcam video
                webcam.srcObject = stream;
                document.getElementById('capture').style.display = 'inline'; // Show capture button
                document.getElementById('cancel').style.display = 'inline'; // Show cancel button
            })
            .catch(err => {
                console.error("Error accessing the webcam: ", err);
            });
    }

    function cancelCapture() {
        // Stop the webcam stream
        if (webcamStream) {
            webcamStream.getTracks().forEach(track => track.stop());
        }

        // Hide the webcam and buttons
        document.getElementById('webcam').style.display = 'none';
        document.getElementById('capture').style.display = 'none';
        document.getElementById('cancel').style.display = 'none';

        // Reset or show the current image if needed
        document.getElementById('currentImage').style.display = 'block';
        document.getElementById('arrow').style.display = 'none';
        document.getElementById('newImagePreview').style.display = 'none';
    }

</script>