<div class="main-section p-3 m-3 shadow-lg bg-white d-flex flex-column">
    <div>    
        <div class="row g-4 mb-4">
            <div class="d-flex align-items-center">
                <svg style="color: rgb(37 99 235);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-headset-icon lucide-headset"><path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Zm0 0a9 9 0 1 1 18 0m0 0v5a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3Z"/><path d="M21 16v2a4 4 0 0 1-4 4h-5"/></svg>
                <h5 class="card-title ms-2 mt-1">Messagerie de support</h5>
            </div>
        </div>

        <form id="chat-send">
            <input type="hidden" id="id" value="<?= $user['id_user'] ?>">
            <input type="hidden" id="name" value="<?= $user['nom'] . " " . $user['prenom'] ?>">
            <input type="hidden" id="email" value="<?= $user['email'] ?>">

            <textarea style="resize:none" class="form-control" id="chat-room" rows="20" readonly></textarea>

            <div class="input-group mb-3 mt-2">
                <span class="input-group-text" id="basic-addon1">Message ></span>
                <input name="input" id="input-com-add" type="text" class="form-control" placeholder="Entrez votre message">
                <button id="button-com-add" class="btn btn-outline-success" type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</div>
<script src="assets/js/support.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>