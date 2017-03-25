<link rel="stylesheet" type="text/css" href="/common/tokeninput/css/token-input.css"/>
<link rel="stylesheet" type="text/css" href="/common/tokeninput/css/token-input-facebook.css"/>
<script type="text/javascript" src="/common/tokeninput/js/jquery.tokeninput.js"></script>
<style>
    ul.token-input-list {
        background-color: rgba(245, 245, 245, 0.35);
        border: medium none;
        border-radius: 0;
        color: #66615b;
        font-size: 14px;
        transition: background-color 0.3s ease 0s;
        padding: 4px;
        /* height: 40px; */
        -webkit-box-shadow: none;
        box-shadow: none;
        border: solid 1px #C9C8C6;
        width:100%;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {

        $("#names").tokenInput("/users/findUser", { propertyToSearch: 'last_name' });
    });
</script>