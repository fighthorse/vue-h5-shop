/* eslint-disable */
let bindToGlobal = (obj, key='var') => {
    if (typeof window[key] === 'undefined') {
        window[key] = {};
    }
    
    for (let i in obj) {
        window[key][i] = obj[i]
    }
}

//配置全局变量
httpConfig = {
	'apiurl':'http://api.fighthorse.cn',
};

weixinConfig = {

};
historyConfig = {
	'history' :[]
}
bindToGlobal(httpConfig, '_httpconfig');
bindToGlobal(weixinConfig, '_weixinconfig');
bindToGlobal(historyConfig, '_historyconfig');
