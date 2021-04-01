window.onload = closeAndOpenChangeProfilePicture;

function closeAndOpenChangeProfilePicture() {
    let newProfilePicture = document.getElementById('newProfilePicture');
    let wholePictureDiv = document.getElementById('newProfilePictureDiv');
    let pictureForm = document.getElementById('pictureForm');

    newProfilePicture.addEventListener('click', (event) => {
        wholePictureDiv.style.display = 'flex';
    });

    wholePictureDiv.addEventListener('click', (event) => {
        let isClickedInside = pictureForm.contains(event.target);

        if (!isClickedInside) {
            wholePictureDiv.style.display = 'none';
        }
    });
}


