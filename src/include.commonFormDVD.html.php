


<?php
    // Fill in these values before including:
    
    // $actionTarget   = "";    // Override before include
    // $readPostValues = false; // Enable post readback in echoValue()
    // $formFeedback   = [];    // Fill in to provide feedback next to fields
    // $formValues     = [];    // Fill in to give values for fields
    
    // $isFormUpdateOrCreate = true;
    // $isFormDelete         = false;
    
    
    
    function echoFeedback( $for ) {
        global $formFeedback;
        
        if (isset( $formFeedback[ $for ] ))
            echo "* " . htmlspecialchars($formFeedback[ $for ]);
    }
    
    
    
    function echoValue( $for ) {
        global $formValues, $readPostValues;
        
        $source = ($readPostValues) ? $_POST : $formValues;
        
        if (isset( $source[ $for ] )) 
            echo htmlspecialchars( $source[ $for ] );
    }
    
    
    
    function echoReadOnly() {
        global $isFormDelete;
        
        if ($isFormDelete)
            echo "readonly";
    }
?>



<form action="<?php echo $actionTarget ?>"
      method="post">
    
    <fieldset>
        <legend>DVD Info</legend>
        
        
        <input name="dvdID" 
               type="hidden"
               value="<?php echoValue("dvdID"); ?>" />
        
        
        <div>
            <label for="title">
                Title
            </label>
            <input class="textInput"
                   name ="title"
                   id   ="title"
                   value="<?php echoValue("title"); ?>"
                   <?php echoReadOnly(); ?> />
            <output>
                <?php echoFeedback("title"); ?>
            </output>
        </div>
        
        
        <div>
            <label for="cert">
                Cert
            </label>
            <select class="textInput" 
                    name ="cert"
                    id   ="cert"
                    <?php echoReadOnly(); ?> >
                <option value="G"> G </option>
                <option value="PG">PG</option>
                <option value="12">12</option>
                <option value="15">15</option>
                <option value="18">18</option>
            </select>
            <output>
                <?php echoFeedback("cert"); ?>
            </output>
        </div>
        
        
        <div>
            <label for="releaseDate">
                Release Date
            </label>
            <input class="textInput"
                   name ="releaseDate"
                   id   ="releaseDate"
                   value="<?php echoValue("releaseDate"); ?>"
                   <?php echoReadOnly(); ?> />
            <output>
                <?php echoFeedback("releaseDate"); ?>
            </output>
        </div>
        
        
        <div>
            <label for="filmDuration">
                Duration
            </label>
            <input class="textInput"
                   name ="filmDuration"
                   id   ="filmDuration"
                   value="<?php echoValue("filmDuration"); ?>"
                   <?php echoReadOnly(); ?> />
            <output>
                <?php echoFeedback("filmDuration"); ?>
            </output>
        </div>
        
        
        <div>
            <label for="director">
                Director
            </label>
            <input class="textInput"
                   name ="director"
                   id   ="director"
                   value="<?php echoValue("director"); ?>"
                   <?php echoReadOnly(); ?> />
            <output>
                <?php echoFeedback("director"); ?>
            </output>
        </div>
        
        
        <div>
            <label for="description">
                Description
            </label>
            <textarea class="textInput"
                      name ="description"
                      id   ="description"
                      <?php echoReadOnly(); ?> ><?php echoValue("description"); ?></textarea>
            <output>
                <?php echoFeedback("description"); ?>
            </output>
        </div>
    </fieldset>

    
    
    <?php if ($isFormUpdateOrCreate) { ?>
        <input class="formButton"
               id   ="submitButton" 
               type ="submit"
               name ="submit"
               value="Save" />
               
        <input class="formButton"
               id   ="resetButton" 
               type ="reset"
               value="Reset" />
    <?php } ?>



    <?php if ($isFormDelete) { ?>
        <input class="formButton"
               id   ="deleteButton" 
               type ="submit"
               name ="submit"
               value="Delete" />
    <?php } ?>

</form>














