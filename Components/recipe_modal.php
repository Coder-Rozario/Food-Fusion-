<!-- Recipe Detail Popup -->
<div id="recipe_Modal" class="popup">
    <div class="popup-content recipe-modal-content">
        <span class="close" onclick="closeRecipe()">&times;</span>
        <img id="popImage" src="" class="recipe-pop-image">
        <h2 id="popTitle" class="recipe-pop-title"></h2>
        
        <div class="recipe-meta-grid">
            <div class="meta-item">
                <i class="fas fa-utensils"></i>
                <span id="popCuisine"></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-layer-group"></i>
                <span id="popDifficulty"></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-leaf"></i>
                <span id="popDietary"></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-clock"></i>
                <span>Prep: <span id="popPrep"></span>m</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-fire"></i>
                <span>Cook: <span id="popCook"></span>m</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-users"></i>
                <span>Servings: <span id="popServings"></span></span>
            </div>
        </div>
        
        <div class="section-margin-bottom">
            <h4 class="recipe-pop-section-title">Ingredients:</h4>
            <p id="popIngredients" class="recipe-pop-text"></p>
        </div>
        
        <div>
            <h4 class="recipe-pop-section-title">Instructions:</h4>
            <p id="popInstructions" class="recipe-pop-text"></p>
        </div>
    </div>
</div>

<script>
    function showRecipe(title, ingredients, instructions, image, cuisine, difficulty, dietary, prep, cook, servings) {
        document.getElementById('popTitle').innerText = title;
        document.getElementById('popIngredients').innerText = ingredients;
        document.getElementById('popInstructions').innerText = instructions;
        document.getElementById('popImage').src = image;
        
        // New fields
        document.getElementById('popCuisine').innerText = cuisine || 'N/A';
        document.getElementById('popDifficulty').innerText = difficulty || 'N/A';
        document.getElementById('popDietary').innerText = dietary || 'None';
        document.getElementById('popPrep').innerText = prep || '0';
        document.getElementById('popCook').innerText = cook || '0';
        document.getElementById('popServings').innerText = servings || '0';

        document.getElementById('recipe_Modal').style.display = 'block';
    }

    function closeRecipe() {
        document.getElementById('recipe_Modal').style.display = 'none';
    }

    // Close when clicking outside
    window.addEventListener('click', function(event) {
        var modal = document.getElementById('recipe_Modal');
        var joinModal = document.getElementById('joinPopup');
        
        if (event.target == modal) {
            modal.style.display = "none";
        }
        if (joinModal && event.target == joinModal) {
            joinModal.style.display = "none";
        }
    });
</script>
