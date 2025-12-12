// Get CSRF token from meta tag
function getCsrfToken() {
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    return metaTag ? metaTag.getAttribute('content') : '';
}

function getRoleColor(role) {
    const colors = {
        'admin': '#dc2626',
        'student': '#2563eb',
        'alumni': '#0b6623',
        'employee': '#ea580c'
    };
    return colors[role] || '#0b6623';
}

function formatReply(reply) {
    const roleColor = getRoleColor(reply.user_role);
    return `
        <div class="reply-box" style="margin-left: 30px; margin-top: 10px; padding: 10px; background: #f9f9f9; border-left: 3px solid #0b6623; border-radius: 5px;">
            <b>${reply.user_name}</b>
            <span style="background:${roleColor};color:white;padding:2px 6px;border-radius:5px;font-size:11px;">${reply.user_role.toUpperCase()}</span>
            <p style="margin-top: 6px; margin-bottom: 4px;">${reply.content}</p>
            <small style="color: #666; font-size: 10px;">${reply.created_at}</small>
        </div>
    `;
}

function formatPost(post) {
    const roleColor = getRoleColor(post.user_role);
    const repliesHtml = post.replies && post.replies.length > 0 
        ? `<div class="replies-container" style="margin-top: 10px;">${post.replies.map(formatReply).join('')}</div>` 
        : '';
    
    return `
        <div class="post-box" data-post-id="${post.id}" style="margin-bottom: 20px;">
            <b>${post.user_name}</b>
            <span style="background:${roleColor};color:white;padding:2px 6px;border-radius:5px;font-size:12px;">${post.user_role.toUpperCase()}</span>
            <p style="margin-top: 8px; margin-bottom: 8px;">${post.content}</p>
            <div style="display: flex; align-items: center; gap: 10px; margin-top: 8px;">
                <small style="color: #666; font-size: 11px;">${post.created_at}</small>
                <button onclick="showReplyForm(${post.id})" style="background: #0b6623; color: white; border: none; padding: 4px 12px; border-radius: 15px; font-size: 11px; cursor: pointer; font-weight: bold;">Reply</button>
                ${post.replies && post.replies.length > 0 ? `<span style="color: #666; font-size: 11px;">${post.replies.length} ${post.replies.length === 1 ? 'reply' : 'replies'}</span>` : ''}
            </div>
            ${repliesHtml}
            <div id="replyForm-${post.id}" style="display: none; margin-top: 10px; padding: 10px; background: #f0f0f0; border-radius: 5px;">
                <textarea id="replyText-${post.id}" rows="2" placeholder="Write a reply..." style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; outline: none; resize: vertical; font-family: Arial, sans-serif; font-size: 13px;"></textarea>
                <div style="margin-top: 8px; display: flex; gap: 8px;">
                    <button onclick="submitReply(${post.id})" style="background: #0b6623; color: white; border: none; padding: 6px 15px; border-radius: 15px; font-size: 12px; cursor: pointer; font-weight: bold;">Post Reply</button>
                    <button onclick="cancelReply(${post.id})" style="background: #ccc; color: #333; border: none; padding: 6px 15px; border-radius: 15px; font-size: 12px; cursor: pointer;">Cancel</button>
                </div>
            </div>
        </div>
    `;
}

async function loadPosts() {
    try {
        const response = await fetch('/posts', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (response.ok) {
            const posts = await response.json();
            const postsArea = document.getElementById("postsArea");
            if (postsArea) {
                if (posts.length === 0) {
                    postsArea.innerHTML = '<div class="post-box"><p style="color: #666; text-align: center;">No posts yet. Be the first to post!</p></div>';
                } else {
                    postsArea.innerHTML = posts.map(formatPost).join('');
                }
            }
        }
    } catch (error) {
        console.error('Error loading posts:', error);
    }
}

async function addPost(parentId = null) {
    let textInput;
    if (parentId) {
        textInput = document.getElementById(`replyText-${parentId}`);
    } else {
        textInput = document.getElementById("postText");
    }
    
    if (!textInput) return;
    
    let text = textInput.value.trim();
    if (text === "") return;

    const postsArea = document.getElementById("postsArea");
    if (!postsArea) return;

    // Disable button and input while posting
    const button = textInput.parentElement ? textInput.parentElement.querySelector('button') : textInput.nextElementSibling;
    if (button) button.disabled = true;
    textInput.disabled = true;

    try {
        const response = await fetch('/posts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({ 
                content: text,
                parent_id: parentId
            })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            if (parentId) {
                // Reload all posts to show the new reply
                loadPosts();
                // Hide reply form
                cancelReply(parentId);
            } else {
                // Add the new post at the top
                const newPostHtml = formatPost({...data.post, replies: []});
                if (postsArea.innerHTML.includes('No posts yet')) {
                    postsArea.innerHTML = newPostHtml;
                } else {
                    postsArea.innerHTML = newPostHtml + postsArea.innerHTML;
                }
                textInput.value = "";
                // Reset textarea height
                textInput.style.height = 'auto';
            }
        } else {
            alert('Failed to post. Please try again.');
        }
    } catch (error) {
        console.error('Error posting:', error);
        alert('An error occurred. Please try again.');
    } finally {
        // Re-enable button and input
        if (button) button.disabled = false;
        if (textInput) textInput.disabled = false;
    }
}

function showReplyForm(postId) {
    const replyForm = document.getElementById(`replyForm-${postId}`);
    if (replyForm) {
        replyForm.style.display = 'block';
        const textarea = document.getElementById(`replyText-${postId}`);
        if (textarea) {
            textarea.focus();
        }
    }
}

function cancelReply(postId) {
    const replyForm = document.getElementById(`replyForm-${postId}`);
    if (replyForm) {
        replyForm.style.display = 'none';
        const textarea = document.getElementById(`replyText-${postId}`);
        if (textarea) {
            textarea.value = '';
        }
    }
}

function submitReply(postId) {
    addPost(postId);
}

// Load posts when page loads
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        loadPosts();
        setupEnterKeySupport();
    });
} else {
    loadPosts();
    setupEnterKeySupport();
}

// Support Enter key to submit (Ctrl+Enter or Shift+Enter for new line)
function setupEnterKeySupport() {
    const textInput = document.getElementById("postText");
    if (textInput) {
        textInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey && !e.ctrlKey && !e.metaKey) {
                e.preventDefault();
                addPost();
            }
        });
    }
}

window.addPost = addPost;
window.loadPosts = loadPosts;
window.showReplyForm = showReplyForm;
window.cancelReply = cancelReply;
window.submitReply = submitReply;

