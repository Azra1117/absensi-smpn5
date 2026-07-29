<style>

body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:linear-gradient(135deg,#2563eb,#10b981);
    min-height:100vh;
}

.container{
    max-width:1200px;
    width:95%;
    min-height:700px;
    margin:30px auto;
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    display:flex;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.left{
    width:50%;
    padding:50px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.right{
    width:50%;
    position:relative;
}

.right img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.overlay{
    position:absolute;
    inset:0;
    background:rgba(37,99,235,.35);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    color:#fff;
    text-align:center;
}

.logo{
    display:flex;
    align-items:center;
    gap:20px;
    margin-bottom:40px;
}

.logo img{
    width:80px;
}

h1{
    font-size:38px;
    color:#2563eb;
    margin:0;
}

h2{
    color:#666;
    font-weight:400;
    font-size:20px;
}

label{
    margin-top:20px;
    display:block;
    font-weight:bold;
}

input{
    width:100%;
    padding:14px;
    margin-top:8px;
    border-radius:10px;
    border:1px solid #ddd;
    font-size:16px;
}

button{
    width:100%;
    margin-top:30px;
    padding:15px;
    border:none;
    border-radius:10px;
    background:#2563eb;
    color:#fff;
    font-size:18px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

.error{
    color:red;
    margin-top:15px;
}

/* ========================= */
/* MOBILE */
/* ========================= */

@media(max-width:768px){

.container{
    width:95%;
    min-height:auto;
    flex-direction:column;
    margin:15px auto;
}

.left{
    width:100%;
    padding:30px 20px;
}

.right{
    display:none;
}

.logo{
    flex-direction:column;
    text-align:center;
}

.logo img{
    width:70px;
}

h1{
    font-size:28px;
}

h2{
    font-size:16px;
}

input{
    padding:13px;
}

button{
    padding:14px;
}

}

</style>