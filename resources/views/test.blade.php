<div v-if="!image" style="position:relative;display:inline-block">
                 <div style="border:1px solid #ddd; border-radius:10px;
                 background-color:#efefef; padding:3 15 3 10; margin-bottom:10px">
                 <i class="fa fa-file-image-o"></i> <b>photo</b>
                  <input type="file" @change="onFileChange" style="position:absolute;
                  left:0;top:0; opacity:0"/>
                  </div>
                  </div>

                  <div v-else>

                <div class="upload_wrap">
                    <textarea v-model="content" id="postText" class="form-control"
                    placeholder="what's on your mind ?"></textarea>
                      <b @click="removeImg" style="right:0;position:absolute;cursor:pointer">Cancel</b>
                  <img :src="image" style="width:100px; margin:10px;"/><br>
