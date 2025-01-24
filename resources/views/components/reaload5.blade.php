<style>
    #container {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #3a2585b2;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    .spinner {
        width: 90px;
        height: 90px;
        border: 7px solid #ff0000;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spinner 1s linear infinite;
    }

    /* Keyframes for spinner animation */
    @keyframes spinner {
        from {
            transform: rotate(0deg);
            /* Starting rotation */
        }

        to {
            transform: rotate(360deg);
            /* End rotation (complete 360-degree turn) */
        }
    }

    /* Optional: Content styling to test after the loader disappears */
    #content {
        text-align: center;
        margin-top: 100px;
        /* Some margin for the content to look spaced */
    }

</style>
<div id="container">
    {{-- <img src="{{asset('img/image.png')}}" alt=""> --}}
    <h1>DoubleClicke IT</h1>

    <div class="spinner">

    </div>

</div>


<script>
    var lod = document.getElementById('container');
    window.addEventListener(
        "load"
        , function() {
            lod.style.display = "none";
        }
    )

</script>

<script>
    setInterval(function() {
        location.reload();
    }, 10000*6*5);

</script>
