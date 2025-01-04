
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="icon"
      type="image/x-icon"
      href="assets/img/background/fav-logo.png"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>CodeCraft - Profile Setup</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");
        * { font-family: "Syne", serif; }
        .skill-box { @apply flex items-center justify-center p-3 border border-gray-300 rounded-lg cursor-pointer transition-all bg-gray-200; }
        .selected { @apply bg-purple-600 text-white border-purple-700; }
        #profilePreview { display: none; width: 100px; height: 100px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-3xl bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold text-purple-600 text-center mb-6">Complete Your Profile</h2>
        <form id="profileForm" enctype="multipart/form-data" class="space-y-4">
            <div><label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="full_name" required class="w-full px-4 py-2 border rounded-md">
            </div>

            <div><label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" required class="w-full px-4 py-2 border rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                <input type="file" name="profile_pic" id="profilePicInput" accept="image/*" class="w-full px-4 py-2 border rounded-md">
                <img id="profilePreview">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Select Your Skills</label>
                <div id="skillsContainer" class="grid grid-cols-3 gap-4 mt-2"></div>
                <input type="hidden" name="skills" id="skillsInput">
                <div class="mt-2 text-gray-600 text-sm">Selected Skills: <span id="selectedSkills">None</span></div>
            </div>

            <div><label class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea name="bio" rows="3" class="w-full px-4 py-2 border rounded-md"></textarea>
            </div>

            <div><label class="block text-sm font-medium text-gray-700">LinkedIn Profile (Optional)</label>
                <input type="url" name="linkedin" class="w-full px-4 py-2 border rounded-md">
            </div>

            <div><label class="block text-sm font-medium text-gray-700">GitHub Profile (Optional)</label>
                <input type="url" name="github" class="w-full px-4 py-2 border rounded-md">
            </div>

            <div><label class="block text-sm font-medium text-gray-700">Portfolio Website (Optional)</label>
                <input type="url" name="portfolio" class="w-full px-4 py-2 border rounded-md">
            </div>

            <div class="flex justify-center"><button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-full">Save Profile</button></div>
            <div id="responseMessage" class="text-center mt-3"></div>
        </form>
    </div>

    <script>
    document.getElementById("profilePicInput").onchange = function(event) {
        const preview = document.getElementById("profilePreview");
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = "block";
    };

    document.getElementById("profileForm").onsubmit = async function(event) {
        event.preventDefault();

        // Ensure skills are correctly sent
        document.getElementById("skillsInput").value = document.getElementById("selectedSkills").textContent;

        const formData = new FormData(this);

        try {
            const response = await fetch("backend/ud/profile_setup.php", { 
                method: "POST", 
                body: formData 
            });

            const result = await response.json();
            console.log(result); // Debugging

            const messageDiv = document.getElementById("responseMessage");

            if (result.status === "success") {
                messageDiv.innerHTML = `<p class="text-green-600">${result.message}</p>`;
                setTimeout(() => {
                    window.location.href = "dashboard.php"; // Redirect to dashboard after success
                }, 2000);
            } else {
                messageDiv.innerHTML = `<p class="text-red-600">${result.message}</p>`;
            }
        } catch (error) {
            console.error("Error submitting form:", error);
            document.getElementById("responseMessage").innerHTML = `<p class="text-red-600">An error occurred. Check the console.</p>`;
        }
    };

    const skillsList = ["Data Structures", "Algorithms", "Operating Systems", "Computer Networks", "Database Management",
        "Machine Learning", "Artificial Intelligence", "Cybersecurity", "Cloud Computing", "Big Data",
        "Software Engineering", "Web Development", "Mobile Development", "Blockchain", "Embedded Systems",
        "Computer Vision", "Deep Learning", "DevOps", "Distributed Systems", "Quantum Computing"];

    const selectedSkills = new Set();
    const skillsContainer = document.getElementById("skillsContainer");
    const selectedSkillsText = document.getElementById("selectedSkills");

    function updateSelectedSkills() {
        selectedSkillsText.textContent = selectedSkills.size ? Array.from(selectedSkills).join(", ") : "None";
    }

    function toggleSkill(skill, element) {
        if (selectedSkills.has(skill)) {
            selectedSkills.delete(skill);
            element.classList.remove("selected");
        } else {
            selectedSkills.add(skill);
            element.classList.add("selected");
        }
        updateSelectedSkills();
    }

    skillsList.forEach(skill => {
        const div = document.createElement("div");
        div.className = "skill-box";
        div.textContent = skill;
        div.onclick = function () { toggleSkill(skill, div); };
        skillsContainer.appendChild(div);
    });

    updateSelectedSkills();
</script>

</body>
</html>
