document.addEventListener("DOMContentLoaded", () => {
    
    const acknowledgeButtons = document.querySelectorAll(".acknowledge-btn");
    acknowledgeButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const alertBox = button.parentElement;
            alertBox.style.display = "none";
            alert("Alert acknowledged!");
        });
    });

   
    const postUpdateForm = document.getElementById("post-update-form");
    const postsContainer = document.getElementById("posts");

    
    postUpdateForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const postContent = document.getElementById("post-content").value.trim();
        const targetDepartment = document.getElementById("target-department").value;

        if (postContent === "") return;

        const post = document.createElement("div");
        post.classList.add("post");
        post.innerHTML = `
            <p><strong>${targetDepartment === "all" ? "All Departments" : targetDepartment}:</strong> ${postContent}</p>
            <div class="reactions">
                <button class="like-btn">👍 Like</button>
                <button class="comment-btn">💬 Comment</button>
            </div>
            <div class="comments"></div>
        `;

        postsContainer.prepend(post);
        postUpdateForm.reset();

        addPostInteractions(post);
    });

   
    const existingPosts = document.querySelectorAll(".post");
    existingPosts.forEach((post) => addPostInteractions(post));

   
    function addPostInteractions(post) {
        const likeButton = post.querySelector(".like-btn");
        const commentButton = post.querySelector(".comment-btn");
        const commentsContainer = post.querySelector(".comments");

        likeButton.addEventListener("click", () => {
            const likeCount = likeButton.dataset.likes ? parseInt(likeButton.dataset.likes) : 0;
            const newCount = likeCount + 1;
            likeButton.dataset.likes = newCount;
            likeButton.textContent = `👍 Like (${newCount})`;
        });

        commentButton.addEventListener("click", () => {
            const commentText = prompt("Enter your comment:");
            if (commentText && commentText.trim() !== "") {
                const comment = document.createElement("p");
                comment.innerHTML = `<strong>You:</strong> ${commentText}`;
                commentsContainer.appendChild(comment);
            }
        });
    }
});
