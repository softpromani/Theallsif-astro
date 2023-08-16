@extends('frontend.layout.frontend')

@section('content-area')
<style>
  .card-payment {
    box-shadow: 0px 0px 35px -20px;
    padding: 5px;
    margin: 10px 0px 40px 0px;
    border-radius: 20px;
  }

  .chat-header-section {
    background: #FACC2E;
    padding: 10px;
    border-radius: 20px;
  }

  .end-chat-btn {
    float: right;
    background: red;
    color: #fff;
    padding: 5px 20px;
    font-size: 20px;
    border-radius: 10px 0px 10px 0px;
  }

  .chat-duration-time-section {
    text-align: center;
    font-size: 25px;
    margin: 15px;

  }

  .chat-text-section span {
    background: #fff7db;
    padding: 10px;
    /* margin-bottom: 28px; */
    border-radius: 20px 0px 20px 0px;
    /* margin-top: 20px; */
    color: #000;
  }

  .chat-text-section {
    margin: 20px;
  }

  .chat-text-section p {
    margin-top: 15px;
    font-size: 12px;
  }

  .chat-text-reply-section span {
    background: #ffd2ff;
    padding: 10px;
    /* margin-bottom: 28px; */
    border-radius: 20px 0px 20px 0px;
    /* margin-top: 20px; */
    color: #000;
  }

  .chat-text-reply-section {
    margin: 20px;
    float: right;
  }

  .chat-text-reply-section p {
    margin-top: 15px;
    font-size: 12px;
  }

  /*.chat-container {*/
  /*  max-width: 600px;*/
  /*  margin: 0 auto;*/
  /*  padding: 20px;*/
  /*}*/

  /*.chat-messages {*/
  /*  border: 1px solid #ccc;*/
  /*  border-radius: 5px;*/
  /*  height: 300px;*/
  /*  overflow-y: scroll;*/
  /*  padding: 10px;*/
  /*}*/

  .chat-input {
    display: flex;
    align-items: center;
    margin: 20px;
    padding: 10px;
    background: #f1f1f1;
    border-radius: 20px 0px 20px 0px;
  }

  .chat-input input[type="text"] {
    margin-right: 5px;
    width: 100%;
    /*padding: 15px;*/
    border: none;
    background: #f1f1f1;
    /*border-radius: 20px 0px 20px 0px;*/
  }

  .chat-input input[type="text"],
  .chat-input button {
    margin-right: 5px;
  }

  .chat-input input[type="file"] {
    display: none;
  }

  .attachment-icons {
    display: flex;
  }

  .attachment-icons label {
    background-color: #e6e6e6;
    padding: 5px;
    border-radius: 5px;
    cursor: pointer;
    margin: 5px;
  }

  .attachment-icons label:hover {
    background-color: #d4d4d4;
  }

  @media screen and (max-width: 768px) {
    .end-chat-btn {
      position: absolute;
      right: 20px;
      top: -30px;
    }
  }

  @media screen and (max-width: 768px) {
    .chat-duration-time-section {
      font-size: 17px;
    }
  }
</style>

<div class="hs_latest_news_main_wrapper mobile-view-astro" style="padding: 25px;margin-top: 5%;">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

    <div class="container ">

      <div class="row ">

        <div class="col-md-2">

        </div>

        <div class="col-md-8">
          <div class="card-payment">
            <div class="chat-container">
              <div class="chat-messages" id="chatMessages">
                <div class="chat-header-section">
                  <div class="row">
                    <div class="col-md-6">
                      <h3>Raj SIddhatha </h3>
                    </div>
                    <div class="col-md-6">
                      <a href="#" class="end-chat-btn">End</a>
                    </div>
                  </div>
                </div>

                <div class="chat-duration-time-section">
                  <span>Duration : 02min : sec 10</span>
                </div>

                <div class="chat-area-section">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chat-text-section">
                        <span>How Are You Today and How Can Help You?</span>
                        <p>May 22, 01:38 PM</p>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="chat-text-section">
                        <span>Hello! Are You Online</span>
                        <p>May 22, 01:38 PM</p>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="chat-text-reply-section">
                        <span>Ok Sending</span>
                        <p>May 22, 01:38 PM</p>
                      </div>
                    </div>

                  </div>


                </div>

                <!-- Chat messages will be added dynamically here -->
              </div>
              <div class="chat-input">
                <input type="text" id="messageInput" placeholder="Type your message...">
                <div class="attachment-icons">
                  <label for="sendInput">
                    <i class="fa fa-paper-plane-o" id="sendButton" aria-hidden="true"></i>
                  </label>
                  <!--<button id="sendButton">Send</button>-->

                  <label for="imageInput">
                    <i class="fa fa-camera" aria-hidden="true"></i>
                  </label>
                  <input type="file" id="imageInput" accept="image/*">
                  <label for="galleryInput">
                    <i class="fa fa-file-image-o" aria-hidden="true"></i>
                  </label>
                  <input type="file" id="galleryInput" accept="image/*" capture="gallery">
                </div>
              </div>

            </div>


          </div>

        </div>
        <div class="col-md-2">

        </div>







      </div>
    </div>
  </div>
</div>

<script>
  const chatMessages = document.getElementById("chatMessages");
  const messageInput = document.getElementById("messageInput");
  const sendButton = document.getElementById("sendButton");
  const imageInput = document.getElementById("imageInput");
  const galleryInput = document.getElementById("galleryInput");

  sendButton.addEventListener("click", sendMessage);
  imageInput.addEventListener("change", uploadImage);
  galleryInput.addEventListener("change", selectFromGallery);

  function sendMessage() {
    const message = messageInput.value.trim();
    if (message !== "") {
      appendMessage("You", message);
      messageInput.value = "";
    }
  }

  function uploadImage() {
    const file = imageInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(event) {
        appendImage("You", event.target.result);
      };
      reader.readAsDataURL(file);
    }
  }

  function selectFromGallery() {
    const file = galleryInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(event) {
        appendImage("You", event.target.result);
      };
      reader.readAsDataURL(file);
    }
  }

  function appendMessage(sender, message) {
    const messageElement = document.createElement("div");
    messageElement.textContent = `${sender}: ${message}`;
    chatMessages.appendChild(messageElement);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function appendImage(sender, imageUrl) {
    const imageElement = document.createElement("img");
    imageElement.src = imageUrl;
    imageElement.classList.add("chat-image");
    const senderElement = document.createElement("div");
    senderElement.textContent = sender;
    const containerElement = document.createElement("div");
    containerElement.appendChild(senderElement);
    containerElement.appendChild(imageElement);
    chatMessages.appendChild(containerElement);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }
</script>


@endsection
<!-- script for particular page -->
@section('script-area')

@endsection