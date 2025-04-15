const arrows = document.querySelectorAll(".arrow");
const movieLists = document.querySelectorAll(".movie-list");


// <------------------- Arrow ----------------------------------------->
arrows.forEach((arrow, i) => {
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
  
    // Initial adjustment
    adjustElements();
    
    // Adjust on window resize
    window.addEventListener('resize', adjustElements);
    
    // Optional: Adjust when content changes (e.g., after AJAX load)
    const observer = new MutationObserver(adjustElements);
    movieItems.forEach(item => {
      observer.observe(item, { childList: true, subtree: true, characterData: true });
    });
  });



// ************************************************
// <--------------- TOGGLE-Button ---------------->
// ************************************************


const ball = document.querySelector(".toggle-ball");
const items = document.querySelectorAll(
  ".container,.movie-list-title,.navbar-container,.sidebar,.left-menu-icon,.toggle"
);

ball.addEventListener("click", () => {
  items.forEach((item) => {
    item.classList.toggle("active");
  });
  ball.classList.toggle("active");
});
