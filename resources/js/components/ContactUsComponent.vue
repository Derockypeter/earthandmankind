<template>
    <div class="container articles">
       
        <div class="row main-container">
             <h1>Contact</h1>
            <div class="col l6 s12">
                <h5>Our Location</h5>
                <p class="grey-text text-darken-4">
                    35 Seychelles Avenue off Capitol Oil Market
                </p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="grey-text">Send Us A Mail</h5>
                <div class="row">
                    <form action="mailto:emailhere" class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" placeholder="Enter Subject" id="subject" class="validate">
                            </div>
                            <div class="input-field col s6">
                                <input type="text" placeholder="Enter Name" id="name" class="validate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <textarea type="text" placeholder="Enter Subject" id="topic" class="validate materialize-textarea"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="waves-effect waves-light btn-small">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>