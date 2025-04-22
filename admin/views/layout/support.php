    <!-- Content -->
    <div class="p-4 mt-3">
        <div class="container-fluid">
            <!-- Main Content -->
            <div class="row g-4 mb-4">
                <!-- Header -->
                <div class="d-flex align-items-center">
                    <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-headset-icon lucide-headset"><path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Zm0 0a9 9 0 1 1 18 0m0 0v5a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3Z"/><path d="M21 16v2a4 4 0 0 1-4 4h-5"/></svg>
                    <h5 class="card-title ms-2 mt-1">Messagerie de support</h5>
                </div>
            </div>

            <form id="chat-send">
                <textarea style="resize:none" class="form-control" id="chat-room" rows="10" readonly></textarea>

                <div class="input-group mb-3 mt-2">
                    <span class="input-group-text" id="basic-addon1">Message ></span>
                    <input name="input" id="input-com-add" type="text" class="form-control" placeholder="Entrez votre message">
                    <button id="button-com-add" class="btn btn-outline-success" type="submit">Envoyer</button>
                </div>
            </form>

            <div class="d-flex align-items-center mt-4 mb-4">
                <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rss-icon lucide-rss"><path d="M4 11a9 9 0 0 1 9 9"/><path d="M4 4a16 16 0 0 1 16 16"/><circle cx="5" cy="19" r="1"/></svg>
                <h5 class="card-title ms-2 mt-1">Sessions en cours</h5>
            </div>
            <div id="rooms" class="card p-5 shadow d-flex justify-content-center align-item-center flex-column">
                <a href="index.html?roomId=${roomId}" class="d-flex justify-content-between">
                </a>
            </div>
        </div>
    </div>
                    
    <script src="./js/panel-dropdown.js"></script>
    <script src="./js/support.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>