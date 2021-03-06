//const applicationServerPublicKey = 'BMf9n8cXBU0IrpQ-F1S0aKTykM_B1e9a0gYy9ac1pWbzmsNvZo55akULwjwnxqj-Vg_DDqbnY8Y-wQ0heZVX4mA';

/*
*
*  Push Notifications codelab
*  Copyright 2015 Google Inc. All rights reserved.
*
*  Licensed under the Apache License, Version 2.0 (the "License");
*  you may not use this file except in compliance with the License.
*  You may obtain a copy of the License at
*
*      https://www.apache.org/licenses/LICENSE-2.0
*
*  Unless required by applicable law or agreed to in writing, software
*  distributed under the License is distributed on an "AS IS" BASIS,
*  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
*  See the License for the specific language governing permissions and
*  limitations under the License
*
*/

/* eslint-env browser, es6 */

'use strict';
const applicationServerPublicKey = 'BL9hpXzwKYJyMU86hCmK1tNWvOq56Aw0jiT7mqXbSknqP4Y1aA54Jfer9z68Gl02vDBBG03YMbQWduvnXFcgqf0';
// FF const applicationServerPublicKey = 'BPQql3uh0PSqabi-ABchl-GWg2IZGPKGjvUIxzKmMCBhMV7ermMjDk4Y6vemnPhVZ2vUUFrMtMsXVuzk0NQFO0Q';
const pushButton = document.querySelector('.js-push-btn');

let isSubscribed = false;
let swRegistration = null;

function urlB64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('Navegador suporta Service Worker e Push');

  navigator.serviceWorker.register('./sw.js', {scope: './server.php'})
  .then(function(swReg) {
    console.log('Service Worker Registrado', swReg);

    swRegistration = swReg;
    initialiseUI();
  })
  .catch(function(error) {
    console.error('Service Worker Erro', error);
  });
} else {
  console.warn('Push messaging não é suportado');
  pushButton.textContent = 'Push não suportado';
}

function initialiseUI() {
  pushButton.addEventListener('click', function() {
  pushButton.disabled = true;
  if (isSubscribed) {
    unsubscribeUser();
  } else {
    subscribeUser();
  }
});

  // Set the initial subscription value
  swRegistration.pushManager.getSubscription()
  .then(function(subscription) {
    isSubscribed = !(subscription === null);

    updateSubscriptionOnServer(subscription);

    if (isSubscribed) {
      console.log('Usuário inscrito (subscribed)');
    } else {
      console.log('Usuário não inscrito (unsubscribed)');
    }

    updateBtn();
  });
}

function updateBtn() {
  if (Notification.permission === 'denied') {
    pushButton.textContent = 'Mensagens push bloqueadas';
    pushButton.disabled = true;
    updateSubscriptionOnServer(null);
    return;
  }

  if (isSubscribed) {
    pushButton.classList.remove('fa-bell');
    pushButton.classList.add('fa-bell-slash');
  } else {
    pushButton.classList.remove('fa-bell-slash');
    pushButton.classList.add('fa-bell');
  }

  pushButton.disabled = false;
}

function subscribeUser() {
  const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
  swRegistration.pushManager.subscribe({
    userVisibleOnly: true,
    applicationServerKey: applicationServerKey
  })
  .then(function(subscription) {
    console.log('Usuário está inscrito');

    updateSubscriptionOnServer(subscription);

    isSubscribed = true;

    updateBtn();
  })
  .catch(function(err) {
    console.log('Falha em inscrever usuário: ', err);
    updateBtn();
  });
}

function updateSubscriptionOnServer(subscription) {
  // TODO: Send subscription to application server
  $('#endpoint').show();
  const subscriptionJson = document.querySelector('.js-subscription-json');
  const subscriptionDetails =
    document.querySelector('.js-subscription-details');

  if (subscription) {
    subscriptionJson.textContent = JSON.stringify(subscription);
    subscriptionDetails.classList.remove('is-invisible');
  } else {
    $('#endpoint').hide();
    subscriptionDetails.classList.add('is-invisible');
  }
}

function unsubscribeUser() {
  swRegistration.pushManager.getSubscription()
  .then(function(subscription) {
    if (subscription) {
      return subscription.unsubscribe();
    }
  })
  .catch(function(error) {
    console.log('Erro no unsubscribe', error);
  })
  .then(function() {
    updateSubscriptionOnServer(null);

    console.log('Usuário foi desinscrito');
    isSubscribed = false;

    updateBtn();
  });
}
