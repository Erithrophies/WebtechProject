document.addEventListener("DOMContentLoaded", () => {
    
    const acknowledgeButtons = document.querySelectorAll(".acknowledge-btn");
    acknowledgeButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const alert = button.parentElement;
            alert.style.display = "none";
            alert("Alert acknowledged!");
        });
    });

   
    const postUpdateForm = document.getElementById("post-update-form");
    const postsContainer = document.getElementById("posts");

    postUpdateForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const postContent = document.getElementById("post-content").value;
        const targetDepartment = document.getElementById("target-department").value;

        
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
            likeButton.dataset.likes = likeCount + 1;
            likeButton.textContent = `👍 Like (${likeButton.dataset.likes})`;
        });

        
        commentButton.addEventListener("click", () => {
            const commentText = prompt("Enter your comment:");
            if (commentText) {
                const comment = document.createElement("p");
                comment.innerHTML = `<strong>You:</strong> ${commentText}`;
                commentsContainer.appendChild(comment);
            }
        });
    }
});