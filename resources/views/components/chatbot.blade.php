{{-- resources/views/components/chatbot.blade.php --}}
<div id="hkc-wrap">
    <button id="hkc-fab" aria-label="Open support chat">
        <svg id="hkc-icon-chat" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <svg id="hkc-icon-close" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="display:none"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        <span id="hkc-badge" style="display:none">1</span>
    </button>

    <div id="hkc-panel">
        <div id="hkc-head">
            <div id="hkc-head-left">
                <div id="hkc-avatar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    <span id="hkc-dot"></span>
                </div>
                <div>
                    <div id="hkc-name">Hamro Koseli Support</div>
                    <div id="hkc-status">&#9679; Online now</div>
                </div>
            </div>
            <button id="hkc-minimize" aria-label="Close chat">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div id="hkc-body">
            <div id="hkc-msgs">
                <div class="hkc-time-label">Today</div>
                <div class="hkc-row hkc-row-bot">
                    <div class="hkc-bubble hkc-bubble-bot">
                        Namaste 🙏 Welcome to <strong>Hamro Koseli!</strong><br>I can help you with orders, payments, shipping, and more.
                    </div>
                </div>
                <div id="hkc-chips">
                    <button class="hkc-chip" data-q="How do I place an order?">🛒 Place order</button>
                    <button class="hkc-chip" data-q="What payment methods do you accept?">💳 Payments</button>
                    <button class="hkc-chip" data-q="How can I track my order?">📦 Track order</button>
                    <button class="hkc-chip" data-q="What is the return policy?">↩️ Returns</button>
                </div>
            </div>
        </div>

        <div id="hkc-foot">
            <form id="hkc-form" autocomplete="off">
                <input id="hkc-input" type="text" placeholder="Ask something..." maxlength="500" aria-label="Message">
                <button type="submit" id="hkc-send" aria-label="Send">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </form>
            <div id="hkc-powered">Hamro Koseli &bull; AI Support</div>
        </div>
    </div>
</div>

<style>
#hkc-wrap{position:fixed;bottom:28px;right:28px;z-index:999999;font-family:'Plus Jakarta Sans',system-ui,sans-serif}

#hkc-fab{
    width:58px;height:58px;border-radius:50%;border:none;
    background:#1a1a1a;color:#fff;cursor:pointer;
    display:flex;align-items:center;justify-content:center;
    box-shadow:0 4px 20px rgba(0,0,0,0.25);
    transition:transform .2s,box-shadow .2s;
    position:relative;
}
#hkc-fab:hover{transform:scale(1.07);box-shadow:0 6px 24px rgba(0,0,0,0.32)}
#hkc-badge{
    position:absolute;top:-3px;right:-3px;
    background:#e53e3e;color:#fff;
    width:18px;height:18px;border-radius:50%;
    font-size:11px;font-weight:700;
    display:flex;align-items:center;justify-content:center;
    border:2px solid #fff;
}

#hkc-panel{
    position:absolute;bottom:72px;right:0;
    width:370px;max-width:calc(100vw - 32px);
    height:540px;max-height:calc(100dvh - 110px);
    background:#fff;border-radius:20px;
    box-shadow:0 20px 60px rgba(0,0,0,0.15),0 4px 16px rgba(0,0,0,0.08);
    display:none;flex-direction:column;overflow:hidden;
}
#hkc-panel.hkc-open{
    display:flex;
    animation:hkc-slide-up .22s cubic-bezier(.34,1.56,.64,1) forwards;
}
@keyframes hkc-slide-up{
    from{opacity:0;transform:translateY(16px) scale(0.96)}
    to{opacity:1;transform:translateY(0) scale(1)}
}

#hkc-head{
    background:#1a1a1a;
    padding:16px 18px;
    display:flex;align-items:center;justify-content:space-between;
    flex-shrink:0;
}
#hkc-head-left{display:flex;align-items:center;gap:12px}
#hkc-avatar{
    width:40px;height:40px;border-radius:50%;
    background:#3a3a3a;
    display:flex;align-items:center;justify-content:center;
    position:relative;flex-shrink:0;
}
#hkc-dot{
    position:absolute;bottom:1px;right:1px;
    width:10px;height:10px;border-radius:50%;
    background:#48bb78;border:2px solid #1a1a1a;
}
#hkc-name{color:#fff;font-size:14px;font-weight:600;letter-spacing:.01em}
#hkc-status{color:#48bb78;font-size:11.5px;margin-top:2px}
#hkc-minimize{
    background:rgba(255,255,255,0.08);border:none;
    color:#ccc;width:32px;height:32px;border-radius:50%;
    cursor:pointer;display:flex;align-items:center;justify-content:center;
    transition:background .15s,color .15s;flex-shrink:0;
}
#hkc-minimize:hover{background:rgba(255,255,255,0.16);color:#fff}

#hkc-body{flex:1;overflow:hidden;display:flex;flex-direction:column}
#hkc-msgs{
    flex:1;overflow-y:auto;
    padding:18px 16px 12px;
    display:flex;flex-direction:column;gap:10px;
    background:#f8f8f7;
    scroll-behavior:smooth;
}
#hkc-msgs::-webkit-scrollbar{width:3px}
#hkc-msgs::-webkit-scrollbar-track{background:transparent}
#hkc-msgs::-webkit-scrollbar-thumb{background:#ddd;border-radius:3px}

.hkc-time-label{
    text-align:center;font-size:11px;color:#aaa;
    font-weight:500;letter-spacing:.04em;
    text-transform:uppercase;margin-bottom:4px;
}
.hkc-row{display:flex;align-items:flex-end;gap:8px}
.hkc-row-bot{flex-direction:row}
.hkc-row-user{flex-direction:row-reverse}

.hkc-bubble{
    padding:11px 15px;
    max-width:78%;font-size:13.5px;line-height:1.55;
    word-break:break-word;white-space:pre-wrap;
}
.hkc-bubble-bot{
    background:#fff;color:#1a1a1a;
    border-radius:4px 18px 18px 18px;
    box-shadow:0 1px 3px rgba(0,0,0,0.07);
    border:1px solid #efefef;
}
.hkc-bubble-user{
    background:#1a1a1a;color:#fff;
    border-radius:18px 18px 4px 18px;
}
.hkc-bubble-error{
    background:#fff0f0;color:#c53030;
    border:1px solid #fed7d7;
    border-radius:4px 18px 18px 18px;
    font-size:13px;
}

#hkc-chips{display:flex;flex-wrap:wrap;gap:7px;padding-top:4px}
.hkc-chip{
    padding:7px 13px;border-radius:20px;
    border:1.5px solid #e2e2e2;background:#fff;
    color:#444;font-size:12px;
    font-family:'Plus Jakarta Sans',system-ui,sans-serif;
    font-weight:500;cursor:pointer;
    transition:border-color .15s,background .15s,color .15s;
    white-space:nowrap;
}
.hkc-chip:hover{border-color:#1a1a1a;background:#1a1a1a;color:#fff}

.hkc-typing{
    display:flex;align-items:center;gap:5px;
    padding:13px 16px;background:#fff;
    border:1px solid #efefef;border-radius:4px 18px 18px 18px;
    box-shadow:0 1px 3px rgba(0,0,0,0.07);
    width:fit-content;
}
.hkc-typing span{
    width:7px;height:7px;border-radius:50%;
    background:#ccc;display:block;
    animation:hkc-blink 1.2s infinite;
}
.hkc-typing span:nth-child(2){animation-delay:.2s}
.hkc-typing span:nth-child(3){animation-delay:.4s}
@keyframes hkc-blink{
    0%,80%,100%{transform:scale(1);opacity:.4}
    40%{transform:scale(1.3);opacity:1}
}

#hkc-foot{
    background:#fff;
    border-top:1px solid #f0f0f0;
    padding:12px 14px 8px;
    flex-shrink:0;
}
#hkc-form{display:flex;align-items:center;gap:8px}
#hkc-input{
    flex:1;min-width:0;
    padding:10px 16px;
    border:1.5px solid #e8e8e8;
    border-radius:24px;
    font-size:13.5px;
    font-family:'Plus Jakarta Sans',system-ui,sans-serif;
    background:#f9f9f9;color:#1a1a1a;
    outline:none;
    transition:border-color .15s,background .15s;
}
#hkc-input:focus{border-color:#1a1a1a;background:#fff}
#hkc-input::placeholder{color:#bbb}
#hkc-send{
    width:40px;height:40px;border-radius:50%;
    border:none;background:#1a1a1a;color:#fff;
    cursor:pointer;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    transition:transform .15s,background .15s;
}
#hkc-send:hover{background:#333;transform:scale(1.06)}
#hkc-send:active{transform:scale(0.95)}
#hkc-powered{
    text-align:center;font-size:11px;color:#ccc;
    margin-top:7px;letter-spacing:.01em;
}

@media(max-width:480px){
    #hkc-wrap{bottom:18px;right:18px}
    #hkc-panel{
        position:fixed;
        top:0;left:0;right:0;bottom:0;
        width:100%;max-width:100%;
        height:100%;max-height:100%;
        border-radius:0;
    }
    #hkc-input{font-size:16px}
}
</style>

<script>
(function(){
    var fab=document.getElementById('hkc-fab'),
        panel=document.getElementById('hkc-panel'),
        minimize=document.getElementById('hkc-minimize'),
        msgs=document.getElementById('hkc-msgs'),
        form=document.getElementById('hkc-form'),
        inp=document.getElementById('hkc-input'),
        chips=document.getElementById('hkc-chips'),
        iconChat=document.getElementById('hkc-icon-chat'),
        iconClose=document.getElementById('hkc-icon-close'),
        csrf=document.querySelector('meta[name="csrf-token"]')?.content,
        history=[],open=false;

    function openPanel(){
        open=true;
        panel.classList.add('hkc-open');
        iconChat.style.display='none';
        iconClose.style.display='block';
        setTimeout(function(){inp.focus();},250);
    }
    function closePanel(){
        open=false;
        panel.classList.remove('hkc-open');
        iconChat.style.display='block';
        iconClose.style.display='none';
    }
    fab.addEventListener('click',function(){open?closePanel():openPanel();});
    minimize.addEventListener('click',closePanel);
    document.addEventListener('keydown',function(e){if(e.key==='Escape'&&open)closePanel();});

    function scroll(){msgs.scrollTop=msgs.scrollHeight;}

    function addBot(html){
        var row=document.createElement('div');
        row.className='hkc-row hkc-row-bot';
        var bub=document.createElement('div');
        bub.className='hkc-bubble hkc-bubble-bot';
        bub.innerHTML=html;
        row.appendChild(bub);
        msgs.appendChild(row);
        scroll();
    }
    function addUser(text){
        var row=document.createElement('div');
        row.className='hkc-row hkc-row-user';
        var bub=document.createElement('div');
        bub.className='hkc-bubble hkc-bubble-user';
        bub.textContent=text;
        row.appendChild(bub);
        msgs.appendChild(row);
        scroll();
    }
    function addTyping(){
        var row=document.createElement('div');
        row.className='hkc-row hkc-row-bot';
        row.id='hkc-typing-row';
        var t=document.createElement('div');
        t.className='hkc-typing';
        t.innerHTML='<span></span><span></span><span></span>';
        row.appendChild(t);
        msgs.appendChild(row);
        scroll();
        return row;
    }
    function addError(msg){
        var row=document.createElement('div');
        row.className='hkc-row hkc-row-bot';
        var bub=document.createElement('div');
        bub.className='hkc-bubble hkc-bubble-error';
        bub.textContent=msg;
        row.appendChild(bub);
        msgs.appendChild(row);
        scroll();
    }

    chips.addEventListener('click',function(e){
        var chip=e.target.closest('.hkc-chip');
        if(!chip)return;
        chips.style.display='none';
        sendMsg(chip.dataset.q);
    });

    form.addEventListener('submit',function(e){
        e.preventDefault();
        var text=inp.value.trim();
        if(!text)return;
        chips.style.display='none';
        inp.value='';
        sendMsg(text);
    });

    function formatReply(text){
        return text
            .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
            .replace(/\*\*(.*?)\*\*/g,'<strong>$1</strong>')
            .replace(/\n/g,'<br>');
    }

    async function sendMsg(text){
        addUser(text);
        history.push({role:'user',content:text});
        var typingRow=addTyping();
        try{
            var res=await fetch('/chatbot/send',{
                method:'POST',
                headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':csrf},
                body:JSON.stringify({messages:history})
            });
            var data=await res.json();
            typingRow.remove();
            if(!res.ok||!data.reply){
                addError(data.error||'Something went wrong. Try again.');
                return;
            }
            addBot(formatReply(data.reply));
            history.push({role:'assistant',content:data.reply});
        }catch(err){
            typingRow.remove();
            addError('Network error. Check your connection.');
        }
    }
})();
</script>