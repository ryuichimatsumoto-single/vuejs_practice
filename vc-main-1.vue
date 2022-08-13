<template>
  <div class="vc-main-1">
    <h1>Hello333</h1>
    <div>
      <p>PARAM</p>
      <span>{{ prms_message }}</span>
    </div>
    <div>
      <input type="text" id="param" v-model="prms" size="60">
    </div>
    <div>
      <button v-on:click="post">入力</button>
    </div>
  </div>
</template>

<script>

module.exports = {
  // 簡単に言うとクラス変数をここで定義
  data(){
    return {
      url : "http://192.168.64.3/php/insert.php",
      res_data : [],
      prms_message : "",
      prms : "",
    }
  },
  methods:{
    //v-on:click="post"時の処理
    post: function(){
      //　axiosにてAjax通信する際のコンフィグ
      config = {
        //　httpヘッダー
        headers:{
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type':'application / x-www-form-urlencoded'
        },
        withCredentials:true,
      }
      // axiosにオブジェクトを持ち越す
      var vmodel_value = this

      //　POST変数をここに定義
      let params = new URLSearchParams();
      //let valid_message = null
      //　v-model:prmsの値が空欄の時
      if(this.prms !== undefined){
        //　POST変数にprmsを追加する
        params.append('prms', this.prms);
      }
      //Ajaxリクエスト
      axios.post(this.url,params)
        .then(function(res){
          //vueにバインドされている値を書き換えると表示に反映される
          console.log(res.data)
          vmodel_value.prms_message = res.data.message
        })
        .catch(function(res){
          //vueにバインドされている値を書き換えると表示に反映される
          console.log(res.data)
        })
    }
  }
}
</script>

<style>
.vc-main-1 h1{
  font-size: 3.5rem;
}
.vc-main-1 p{
  font-weight: bold;
}
</style>


