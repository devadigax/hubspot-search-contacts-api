# Search Contacts

This is a simple web application that allows you to search for contacts using various criteria.

## Usage

1. Fill in one or more of the search fields:
   - **First Name**: Search by the first name of the contact.
   - **Last Name**: Search by the last name of the contact.
   - **Company**: Search by the company name of the contact.

2. Click the **Search** button to initiate the search.

3. The search results will be displayed in a table below.

## Search Form

The search form consists of three input fields and a search button.

- **First Name**: Input field to enter the first name of the contact.
- **Last Name**: Input field to enter the last name of the contact.
- **Company**: Input field to enter the company name of the contact.
- **Search Button**: Click to perform the search based on the entered criteria.

## Search Results

The search results will be displayed in a table with the following columns:

1. **Contact ID**: The unique identifier of the contact.
2. **First Name**: The first name of the contact.
3. **Last Name**: The last name of the contact.
4. **Email**: The email address of the contact (clickable link to send an email).
5. **Last Modified Date**: The date when the contact was last modified.
6. **Create Date**: The date when the contact was created.

If no results are found, a message will be displayed in the table.

## Implementation Details

- The frontend of the application uses Bootstrap for styling.
- The search functionality is implemented using JavaScript and jQuery.
- The search is performed through an AJAX call to a PHP script (`search_contacts.php`).
- The PHP script interacts with the HubSpot API to retrieve search results based on the provided criteria.
- You need to replace `YOUR_HUBSPOT_ACCESS_TOKEN` with your actual HubSpot access token in the PHP script.

Please note that this document is a simplified overview. Refer to the original HTML code for the complete implementation details.

---

For the actual HTML and JavaScript code, please refer to the original source above.
