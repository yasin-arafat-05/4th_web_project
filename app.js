
/*
DOM -> Document Object Model: show html page as a documet tree
- document.getElementByClassName('navbar') -> we can access 
all the property in the javascript object and modify them 
with javascript code.
- document.getElementByID() -> access ID element.
- document.getElementByTagName() -> access a tag.

##
We need 3 things to select 3 different thing.But only using the
querySelector() or querySelectorAll() we can select any thing.
##

##coputedSyteMap():
let elm = document.getElementById("abc")
let css = getComputedSyle(elm) #It will fetch all css property that is applied in ID("abe")#
let value= css.getPropertValue("background-color") #get the background-color#
##
*/

const arrows = document.querySelectorAll(".arrow");
const movieLists = document.querySelectorAll(".movie-list");


// **********************************************************************
// <------------------------ Arrow Behaviour --------------------------->
// **********************************************************************

arrows.forEach((arrow, i) => {
  if (!movieLists[i]) return;
  const itemNumber = movieLists[i].querySelectorAll("img").length;
  let clickCounter = 0;
  arrow.addEventListener("click", () => {
    const ratio = Math.floor(window.innerWidth / 170);
    clickCounter++;
    if (itemNumber - (4 + clickCounter) + (4 - ratio) >= 0) {
      movieLists[i].style.transform = `translateX(${
        movieLists[i].computedStyleMap().get("transform")[0].x.value - 200
      }px)`;
    } else {
      movieLists[i].style.transform = "translateX(0)";
      clickCounter = 0;
    }
  });

  console.log(Math.floor(window.innerWidth / 170));
});


//---------------------------------------------------------------------
// when our line grather then two then small the title and description: 
// The 'DOMContentLoaded' event in JavaScript is an event that 
// fires when the initial HTML document has been completely 
// loaded and parsed, without waiting for stylesheets, images, 
// and subframes to finish loading.
//---------------------------------------------------------------------


document.addEventListener('DOMContentLoaded', function() {
    const movieItems = document.querySelectorAll('.movie-list-item');
  
    function adjustElements() {
      movieItems.forEach(item => {
        const title = item.querySelector('.movie-list-item-title');
        const description = item.querySelector('.moive-list-item-decs');
        const button = item.querySelector('.movie-list-item-button');
        
        // Reset styles to default before calculation
        title.style.fontSize = '';
        description.style.top = '';
        button.style.bottom = '';
        
        // Calculate title height and adjust if needed
        const titleLineHeight = parseFloat(getComputedStyle(title).lineHeight);
        const titleHeight = title.offsetHeight;
        const titleLineCount = Math.round(titleHeight / titleLineHeight);
        // tile line is graeter then 2 then font size will be:16px
        if (titleLineCount >= 2) {
          title.style.fontSize = '16px'; 
        }
        
        // Calculate new title height after potential font size change
        const newTitleHeight = title.offsetHeight;
        
        // Position description below title with some padding
        const titleBottom = newTitleHeight + 20; // 20px padding below title
        description.style.top = `${titleBottom}px`;
        
        // Calculate description height and adjust button position
        const descLineHeight = parseFloat(getComputedStyle(description).lineHeight);
        const descHeight = description.offsetHeight;
        const descLineCount = Math.round(descHeight / descLineHeight);
        
        if (descLineCount >= 5) {
          const descBottom = titleBottom + descHeight + 40; 
          button.style.bottom = `calc(100% - ${descBottom}px)`;
        } else {
          button.style.bottom = '20px';
        }

      });
    }
  
  
    // ------ main code: ---------
    adjustElements();
    window.addEventListener('resize', adjustElements);
    const observer = new MutationObserver(adjustElements);
    movieItems.forEach(item => {
      observer.observe(item, { childList: true, subtree: true, characterData: true });
    });
  });



// ************************************************
// <--------------- Chatbot- ---------------->
// ************************************************
document.addEventListener("DOMContentLoaded", function() {
  const chatbotContainer = document.getElementById("chatbot-container");
  const sendBtn = document.getElementById("send-btn");
  const chatbotInput = document.getElementById("chatbot-input");
  const chatbotMessages = document.getElementById("chatbot-messages");
  const chatbotIcon = document.getElementById("chatbot-icon");
  const closeButton = document.getElementById("close-btn");

  // fetch checkpoint ID:
  let checkpointId = sessionStorage.getItem('chatbotCheckpointId') || null;

  // Expand:
  chatbotIcon.addEventListener("click", function() {
    chatbotContainer.classList.remove("hidden");
    chatbotIcon.style.display = "none";
  });

  // Hidden:
  closeButton.addEventListener("click", function() {
    chatbotContainer.classList.add("hidden");
    chatbotIcon.style.display = "flex";
  });

  /*
    If we want to start a new converstion 
    then we need to clear the screen first.
  */
  function startNewConversation() {
    checkpointId = null;
    sessionStorage.removeItem('chatbotCheckpointId');
    chatbotMessages.innerHTML = ''; 
    appendMessage("bot", "Hello! How can I help you today?");
  }

  //Checkpointer is null or not:
  if (!checkpointId) {
    startNewConversation();
  }

  /*
    Send message section:
  */
  // Send message when clicking Send button
  sendBtn.addEventListener("click", sendMessage);

  // Send message when pressing Enter
  chatbotInput.addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
      sendMessage();
    }
  });

  /*
   Send the user message to the UI:
  */
  function sendMessage() {
    const userMessage = chatbotInput.value.trim();
    if (userMessage) {
      appendMessage("user", userMessage);
      // clear input field:
      chatbotInput.value = "";
      getBotResponse(userMessage);
    }
  }

  /*
  After initial message when we add a new message then:
  */
  function appendMessage(sender, message, isHtml = false) {
    const messageElement = document.createElement("div");
    messageElement.classList.add("message", sender);
    /*Normal text or link or html input*/
    if (isHtml) {
      messageElement.innerHTML = message;
    } else {
      messageElement.textContent = message;
    }
    chatbotMessages.appendChild(messageElement);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
  }

  // ******************************* Get Bot Response *******************************
  async function getBotResponse(userMessage) {
    const url = checkpointId 
      ? `http://localhost:8000/chat/messages?message=${encodeURIComponent(userMessage)}&checkpoint_id=${checkpointId}`
      : `http://localhost:8000/chat/messages?message=${encodeURIComponent(userMessage)}`;

    try {
      const response = await fetch(url, {
        method: "GET",
        headers: { "Accept": "text/event-stream" }
      });

      if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

      const reader = response.body.getReader();
      const decoder = new TextDecoder();
      let botMessageElement = null;
      let botMessageContent = "";

      while (true) {
        const { done, value } = await reader.read();
        if (done) break;

        const chunk = decoder.decode(value, { stream: true });
        const lines = chunk.split("\n").filter(line => line.trim());

        for (const line of lines) {
          if (!line.startsWith("data: ")) continue;
          
          const jsonString = line.substring(6).trim();
          if (!jsonString) continue;

          try {
            const event = JSON.parse(jsonString);
            
            if (event.type === "checkpoint") {
              checkpointId = event.checkpoint_id;
              sessionStorage.setItem('chatbotCheckpointId', checkpointId);
            }
          // ----------------------------------------------------------------
          // ----------------------------------------------------------------
          // ------------------------Content Handler-------------------------
          // ----------------------------------------------------------------
          // ----------------------------------------------------------------
         else if(event.type === "query_in_db"){
              appendMessage("bot",`Query in database: "${event.query}"`)
            }else if (event.type === "search_start") {
              appendMessage("bot", `Searching for "${event.query}"...`);
            }
            else if (event.type === "search_results" && event.urls?.length) {
              const urls = event.urls.map(url => 
                `<a href="${url}" target="_blank" class="search-link">${url}</a>`
              ).join("<br>");
              appendMessage("bot", `Search results:<br>${urls}`, true);
            } else if (event.type === "content") {
              if (typeof event.content === "string") {
                const content = event.content
                  .replace(/\\'/g, "'")
                  .replace(/\\"/g, '"')
                  .replace(/\\n/g, '\n')
                  .replace(/\\\\/g, '\\');
            
                // Create the bot message element if it doesn't exist
                if (!botMessageElement) {
                  botMessageElement = document.createElement("div");
                  botMessageElement.classList.add("message", "bot");
                  chatbotMessages.appendChild(botMessageElement);
                }
            
                console.log(content);
                botMessageContent += content;
                botMessageElement.innerHTML = botMessageContent;
            
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
              }
            }else if (event.type === "end") {
              // Stream ended
              break;
            }

          } catch (e) {
            console.error("Error parsing JSON:", jsonString, e);
          }
        }
      }
    } catch (error) {
      console.error("Error:", error);
      appendMessage("bot", "Sorry, something went wrong. Please try again.");
      startNewConversation();
    }
  }
});

