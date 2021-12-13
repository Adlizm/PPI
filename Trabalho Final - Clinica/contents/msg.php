<script>
    function msgHide() {
        document.querySelector(".msg").style.display = 'none';
        document.querySelector(".msg span").innerHTML = " ";
    }

    function msgShow(message){
        document.querySelector(".msg span").innerHTML = message;
        document.querySelector(".msg").style.display = 'block';
    }
</script>