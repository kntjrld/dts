<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Tracking System</title>
<link rel="stylesheet" href="recstyle.css">
<body>

  <!-- Header (Logo or Website Name) -->
  <div class="header">
    <span>DepED Document Tracking System</span> <!-- Replace with your logo or website name -->
  </div>

  <!-- Hamburger Menu Icon -->
  <div class="hamburger" onclick="toggleSidebar()">
    &#9776; <!-- Hamburger icon (3 horizontal lines) -->
  </div>

  <!-- Sidebar (Left Navigation) -->
  <div class="sidebar" id="sidebar">
    <a href="#" id="tab1" class="tab" onclick="showTab(1)">Home</a>
    <a href="#" id="tab2" class="tab" onclick="showTab(2)">Library</a>
    <a href="#" id="tab3" class="tab" onclick="showTab(3)">Pending for Release</a>
    <a href="#" id="tab4" class="tab" onclick="showTab(4)">Terminal Records</a>
    <a href="#" id="tab5" class="tab" onclick="showTab(5)">Track Processed Records</a>
    <a href="#" id="tab6" class="tab" onclick="showTab(6)">Settings</a>
    <a href="#" id="tab7" class="tab" onclick="showTab(7)">Logout</a>
  </div>
  
  <!-- Content Area (Right part) -->
  <div class="content" id="content">
    <!-- Sections for document actions (Add, Track, Receive, Release) -->
    <div id="section1" class="section active">
      <h2>Add Document</h2>
      <div class="form-container">
        <label for="addDocTitle">Document Title</label>
        <input type="text" id="addDocTitle" placeholder="Enter document title">
        <button onclick="addDocument()">Add Document</button>
      </div>
      <h2>Track Document</h2>
      <div class="form-container">
        <label for="trackDocId">Document ID</label>
        <input type="text" id="trackDocId" placeholder="Enter document ID to track">
        <button onclick="trackDocument()">Track Document</button>
      </div>
    </div>
    <div id="section2" class="section active">
      <h2> Document</h2>
      <div class="form-container">
        <label for="addDocTitle">Document Title</label>
        <input type="text" id="addDocTitle" placeholder="Enter document title">
        <button onclick="addDocument()">Add Document</button>
      </div>
      <h2>Track Document</h2>
      <div class="form-container">
        <label for="trackDocId">Document ID</label>
        <input type="text" id="trackDocId" placeholder="Enter document ID to track">
        <button onclick="trackDocument()">Track Document</button>
      </div>
    </div>
</div>

  <script>
    // Function to show the content of the clicked tab
    function showTab(tabNumber) {
      // Hide all sections
      const sections = document.querySelectorAll('.section');
      sections.forEach(section => section.classList.remove('active'));

      // Remove active class from all tabs
      const tabs = document.querySelectorAll('.tab');
      tabs.forEach(tab => tab.classList.remove('active'));

      // Show the clicked tab's content
      const section = document.getElementById('section' + tabNumber);
      section.classList.add('active');

      // Mark the clicked tab as active
      const tab = document.getElementById('tab' + tabNumber);
      tab.classList.add('active');
    }

    // Function to toggle the sidebar visibility (hamburger menu)
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const content = document.getElementById('content');
      
      sidebar.classList.toggle('open');
      content.classList.toggle('open');
    }

    // Example functions for document actions
    function addDocument() {
      const docTitle = document.getElementById('addDocTitle').value;
      alert('Document "' + docTitle + '" added successfully!');
    }

    function trackDocument() {
      const docId = document.getElementById('trackDocId').value;
      alert('Tracking document with ID: ' + docId);
    }

    function receiveDocument() {
      const docId = document.getElementById('receiveDocId').value;
      alert('Document with ID ' + docId + ' received successfully!');
    }

    function releaseDocument() {
      const docId = document.getElementById('releaseDocId').value;
      alert('Document with ID ' + docId + ' released successfully!');
    }

    // Initialize by showing the first tab's content
    document.addEventListener('DOMContentLoaded', () => showTab(1));
  </script>

  <footer>
        <p>&copy; <span id="year"></span> DepED Document Tracking System. All rights reserved. </p>
    </footer>
    <script>
        //footer
            document.getElementById('year').textContent =new Date().getFullYear();
    </script>
</body>
</html>
