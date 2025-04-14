import { initializeApp} from 'firebase/app';
import { getDatabase, ref } from 'firebase/database';    

const firebaseConfig = {
    apiKey: "AIzaSyBYwJeE2MfSfVaKVSxmKZRdJslWbtxXIEY",
    authDomain: "tabang-ecafd.firebaseapp.com",
    databaseURL: "https://tabang-ecafd-default-rtdb.firebaseio.com",
    projectId: "tabang-ecafd",
    storageBucket: "tabang-ecafd.firebasestorage.app",
    messagingSenderId: "584776665250",
    appId: "1:584776665250:web:4700997b4b566830af2ffb"
  };

  const app = initializeApp(firebaseConfig);
  const database = getDatabase();