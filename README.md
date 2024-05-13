Site doemo: https://wowkdigital.pl/apps/gallery_v2/

<img src="/app_prev" max-width="200">

# Dynamic Photo Gallery

This dynamic photo gallery application allows users to view, select, and save images dynamically loaded from a server directory. Built with PHP, JavaScript, and utilizing jQuery and Masonry for a responsive layout, this application offers a user-friendly experience for photo selection and processing.

## Features

- **Dynamic Photo Loading**: Load images dynamically from the server's directory.
- **Interactive UI**: Select and view photos using checkboxes and a fancybox modal.
- **Responsive Layout**: Masonry layout ensures the gallery is well-organized and responsive.
- **Save Selected Photos**: Users can save selected photos with their name.
- **More Photos on Demand**: Load more photos with the 'Load More' button.
- **Copy Functionality**: Copy the list of selected photos to the clipboard.
- **Error Handling**: Informative popups for errors and actions.

## Prerequisites

Before you can run this application, make sure you have the following installed:
- PHP (Preferably version 7.0 or higher)
- A web server like Apache or Nginx
- jQuery and related plugins (included via CDN in the project)

## Usage

1. **Open the application in a web browser.**

Navigate to the local or hosted URL where the project is served.

2. **View and select photos:**

- Use the checkboxes to select or deselect photos.
- Click on any photo to view it in a larger fancybox modal.

3. **Load more photos:**

- Click the 'Load More' button to dynamically load additional photos into the gallery.

4. **Save selected photos:**

- Enter your name in the input field under "Your Name".
- Click the 'Save' button to save the selected photos. A confirmation popup will appear.

5. **Copy the list of saved photos:**

- In the popup, click 'Copy List' to copy the names of saved photos to the clipboard.

6. **Close the popup:**

- Click 'OK' in the popup to close it and return to the gallery.

## Backend Details

- **PHP Scripts**: Handles the loading of photos from the server and the saving of selected photos.
- **save_photos.php**: A server-side script that should be implemented to handle POST requests when saving photos.

## Frontend Components

- **HTML**: Structures the photo gallery and other UI components.
- **CSS**: (Link to `style.css` in your project) Styles the gallery and popup messages.
- **JavaScript**: 
- **Gallery Initialization**: Uses Masonry and imagesLoaded to lay out the gallery.
- **Fancybox**: For modal photo viewing.
- **Event Handlers**: For loading more photos, saving photos, and copying photo names.

## Scripts

1. **Masonry and imagesLoaded**: For a dynamic and responsive gallery layout.
2. **jQuery**: For DOM manipulation and AJAX requests.
3. **Fancybox**: For handling the photo viewing in a modal overlay.

## File Structure

- `index.php`: Main gallery interface.
- `save_photos.php`: Backend script to save selected photos (implement this based on your needs).
- `style.css`: Styles for the gallery and popups.
- `saveFieldHandler.js`: JavaScript for handling saving photos and popups.

## Contributing

Feel free to fork this repository and submit pull requests. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, email wowk.digital@gmail.com or open an issue on the GitHub repository.
