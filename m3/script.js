
document.addEventListener('DOMContentLoaded', function() {
    // Show welcome cyberpunk alert
    const hasVisited = localStorage.getItem('hasVisitedBefore');
    
    // Add a small delay for a better user experience
    setTimeout(() => {
        if (!hasVisited) {
            Swal.fire({
                title: 'Make  Your Opinion ',
                html: `<div style="line-height: 1.6;">
                    > This is a task management system <br>
                    > Design by Md Majharul Islam<br>
                    > USER AUTHENTICATION: <span style="color: #05d9e8;">SUCCESSFUL</span><br>
                    > WELCOME TO THE <span style="color: #ff2a6d;">DEV-TASK</span> SYSTEM<br>
                    > DRAG THE PANEL TO REPOSITION<br>
                    > DRAG TASKS TO REORDER
                    > Make Your Opinion 
                </div>`,
                icon: null,
                showClass: {
                    popup: 'animate__animated animate__fadeIn faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOut faster'
                },
                confirmButtonText: 'INITIALIZE',
                allowOutsideClick: false,
                backdrop: `
                    rgba(13, 2, 33, 0.7)
                    url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 10L90 90M90 10L10 90' stroke='%2305d9e8' stroke-width='3'/%3E%3C/svg%3E")
                    center center
                    no-repeat
                `,
                didOpen: () => {
                    // Add glitch effect to title
                    document.querySelector('.swal2-title').classList.add('cyberpunk-glitch');
                    
                    // Typewriter effect for text content
                    const textLines = document.querySelector('.swal2-html-container div').innerText.split('\n');
                    document.querySelector('.swal2-html-container div').innerText = '';
                    
                    let lineIndex = 0;
                    let charIndex = 0;
                    const typewriterEl = document.querySelector('.swal2-html-container div');
                    
                    function typeWriter() {
                        if (lineIndex < textLines.length) {
                            if (charIndex < textLines[lineIndex].length) {
                                typewriterEl.innerHTML += textLines[lineIndex].charAt(charIndex);
                                charIndex++;
                                setTimeout(typeWriter, 30);
                            } else {
                                typewriterEl.innerHTML += '<br>';
                                lineIndex++;
                                charIndex = 0;
                                setTimeout(typeWriter, 200);
                            }
                        }
                    }
                    
                    typeWriter();
                }
            }).then(() => {
                localStorage.setItem('hasVisitedBefore', 'true');
            });
        }
    }, 500);
    
    // Make container draggable
    const container = document.getElementById('draggableContainer');
    const dragHandle = document.getElementById('dragHandle');
    
    let isDragging = false;
    let offsetX, offsetY;
    
    // Load saved position from localStorage
    function loadSavedPosition() {
        const savedPosition = localStorage.getItem('containerPosition');
        if (savedPosition) {
            try {
                const position = JSON.parse(savedPosition);
                container.style.position = 'absolute';
                container.style.left = position.left + 'px';
                container.style.top = position.top + 'px';
                container.style.margin = '0';
                // Stop the floating animation if we have a saved position
                container.style.animation = 'none';
            } catch (e) {
                console.error('Error parsing saved position:', e);
            }
        }
    }
    
    // Save position to localStorage
    function savePosition() {
        if (container.style.position === 'absolute') {
            const position = {
                left: parseInt(container.style.left),
                top: parseInt(container.style.top)
            };
            localStorage.setItem('containerPosition', JSON.stringify(position));
        }
    }
    
    // Load saved position on page load
    loadSavedPosition();
    
    // Stop the float animation when dragging
    const startDrag = function(e) {
        // Use touch position if touch event
        const clientX = e.clientX || e.touches[0].clientX;
        const clientY = e.clientY || e.touches[0].clientY;
        
        isDragging = true;
        
        // Get the current position of the element
        const rect = container.getBoundingClientRect();
        
        // Calculate the offset between cursor and container position
        offsetX = clientX - rect.left;
        offsetY = clientY - rect.top;
        
        // Stop the floating animation
        container.style.animation = 'none';
        
        // Prevent default behavior
        e.preventDefault();
    };
    
    const doDrag = function(e) {
        if (!isDragging) return;
        
        // Use touch position if touch event
        const clientX = e.clientX || e.touches[0].clientX;
        const clientY = e.clientY || e.touches[0].clientY;
        
        // Calculate the new position
        const left = clientX - offsetX;
        const top = clientY - offsetY;
        
        // Set the element's new position
        container.style.position = 'absolute';
        container.style.left = left + 'px';
        container.style.top = top + 'px';
        container.style.margin = '0';
        
        e.preventDefault();
    };
    
    const stopDrag = function() {
        if (isDragging) {
            // Save position after drag ends
            savePosition();
            isDragging = false;
        }
    };
    
    // Mouse events
    dragHandle.addEventListener('mousedown', startDrag);
    document.addEventListener('mousemove', doDrag);
    document.addEventListener('mouseup', stopDrag);
    
    // Touch events for mobile
    dragHandle.addEventListener('touchstart', startDrag);
    document.addEventListener('touchmove', doDrag);
    document.addEventListener('touchend', stopDrag);
    
    // Make the entire container draggable (not just the handle)
    container.addEventListener('mousedown', function(e) {
        // Only allow dragging if it's the container itself, not children
        if (e.target === container) {
            startDrag(e);
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        // Don't reset position on resize anymore
        // Just make sure it's not off-screen
        if (container.style.position === 'absolute') {
            const rect = container.getBoundingClientRect();
            if (rect.right < 50 || rect.bottom < 50 || rect.left > window.innerWidth - 50 || rect.top > window.innerHeight - 50) {
                // If almost off-screen, reset
                container.style.position = '';
                container.style.left = '';
                container.style.top = '';
                container.style.margin = '';
                container.style.animation = 'float 6s ease-in-out infinite';
                localStorage.removeItem('containerPosition');
            }
        }
    });
    
    // Drag and drop for list items
    const sortableList = document.getElementById('sortableList');
    
    if (sortableList) {
        const items = sortableList.querySelectorAll('.task-item');
        let dragItem = null;
        
        // Functions for drag and drop
        function handleDragStart(e) {
            // Skip if clicking on action buttons
            if (e.target.closest('.task-actions')) {
                return;
            }
            
            this.classList.add('dragging');
            dragItem = this;
            
            // For mobile: ensure the original element remains in its position during drag
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.innerHTML);
        }
        
        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            
            const targetItem = e.target.closest('.task-item');
            
            if (targetItem && targetItem !== dragItem) {
                // Determine if we should place the dragged item before or after the target
                const targetRect = targetItem.getBoundingClientRect();
                const targetMiddle = targetRect.top + (targetRect.height / 2);
                
                if (e.clientY < targetMiddle) {
                    sortableList.insertBefore(dragItem, targetItem);
                } else {
                    sortableList.insertBefore(dragItem, targetItem.nextSibling);
                }
            }
        }
        
        function handleDragEnd(e) {
            this.classList.remove('dragging');
            
            // Save the new order to the server
            saveNewOrder();
        }
        
        function saveNewOrder() {
            const newItems = sortableList.querySelectorAll('.task-item');
            const newOrder = Array.from(newItems).map(item => item.dataset.index);
            
            // Send to server using fetch API
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'reorder=' + encodeURIComponent(JSON.stringify(newOrder))
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Refresh the page to show the new order
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error saving new order:', error));
        }
        
        // Add drag and drop event listeners to all items
        items.forEach(item => {
            item.setAttribute('draggable', 'true');
            item.addEventListener('dragstart', handleDragStart);
            item.addEventListener('dragover', handleDragOver);
            item.addEventListener('dragend', handleDragEnd);
            
            // Prevent form submission when starting drag on the task text
            const taskText = item.querySelector('.task-text');
            if (taskText) {
                taskText.addEventListener('mousedown', function(e) {
                    e.stopPropagation();
                });
            }
            
            // Make sure action buttons don't trigger drag
            const actionButtons = item.querySelectorAll('.action-btn');
            actionButtons.forEach(btn => {
                btn.addEventListener('mousedown', function(e) {
                    e.stopPropagation();
                });
                
                btn.setAttribute('draggable', 'false');
            });
        });
    }
});
