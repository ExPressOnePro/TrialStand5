<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
    }
</style>

<div class="overlay" id="loadingOverlay" style="display:none;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Загрузка ...</span>
    </div>
</div>
