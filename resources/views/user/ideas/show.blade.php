<div class="idea hidden">
    <div class="main_round">
        <div class="round1">
            <div class="round_left">
                <h2 class="ideaHeader"> APP IDEA </h2>
                <p class="ideaDescription"> </p>
            </div>
            <div class="round_right">
                <img class="image_round" src="https://previews.123rf.com/images/baz777/baz7771108/baz777110800013/10403555-cartoon-computer-being-scared-by-the-mouse-isolated-on-white-background.jpg"
                    alt="">
            </div>
        </div>
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="container_divs">
                <div class="op_card">
                    <img CLASS="image_card" src="https://previews.123rf.com/images/baz777/baz7771108/baz777110800013/10403555-cartoon-computer-being-scared-by-the-mouse-isolated-on-white-background.jpg"
                        alt="">
                    <p class="black_section"> WRITE YOUR CODE <span class="blue_section"> > </span> </p>
                </div>
                <div class="op_card">
                    <img CLASS="image_card" src="https://previews.123rf.com/images/baz777/baz7771108/baz777110800013/10403555-cartoon-computer-being-scared-by-the-mouse-isolated-on-white-background.jpg"
                        alt="">
                    <div>
                        <label for="attachments" multiple> UPLOAD FILES </label>
                        <input multiple type="file" name="attachments[]" id="attachments">
                    </div>
                </div>
            </div>

            <button class="nextStep btn" style="margin-left: auto; display: block; width: 200px">
                FINISH ROUND >
            </button>
        </form>

    </div>
</div>
