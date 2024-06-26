import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            zIndex: {
                '100': '100',
            },
            gap: {
                '48': '48px',
                '91':'91px',
            },
            colors:{
                "titleBlack":"#1E3447",
                "textBlack":"#1E3346",
                "baseColor":"#171C61",
                "buttonLinerStart":"#91CBD8",
                "buttonLinerEnd":"#85D9CA",
                "headLinerStart":"#9EA7F7",
                "headLinerEnd":"#91CBD8",
                "aboutCompany":"#2E2E2E",
                "profile":"#637381",
                "profileName":"#212B36",
                "departStart":"#96BDDA",
                "main":"#f6f5f5",
                "questionIcon":"rgba(145, 203, 216, 0.30)",
                "departEnd":"rgba(255, 255, 255, 0.00)",
                "question":"0px 20px 95px 0px rgba(201, 203, 204, 0.30)",
                "questionBorder":"#F3F4FE",
                "square":"rgba(245, 242, 253, 0.00)",
                "footerBg":"#171C61",
                "footerBall":"#232869",
                "modalTitleBg":"#E4EAEE",
                "dashInputColor":"rgb(3,3,3)",
            },
            width: {
                '7':'7px',
                '20':'20px',
                '30':'30px',
                '36':'36px',
                '42':'42px',
                '60':'60px',
                '100':'80px',
                '110':'110px',
                '130':'130px',
                '150':'150px',
                '180':'180px',
                '270':'270px',
                '275':'275px',
                '300':'300px',
                '350':'350px',
                '400':'400px',
                '419':'419px',
                '447':'447px',
                '469':'469px',
                '495':'495px',
                '500':'500px',
                '570':'570px',
                '600':'600px',
                '682':'682px',
                '771':'771px',
                '1022':'1022px',
                '1000':'1000px',
                '1200':'1200px',
                '1254':'1254px',
                'headArticle':'1380px',
                'maxWidth':'1512px',
                '1820':'1820px',
            },
            height:{
                '18':'18px',
                '20':'20px',
                '30':'30px',
                '36':'36px',
                '42':'42px',
                '70':'70px',
                '100':'100px',
                '120':'120px',
                '150':'150px',
                '175':'175px',
                '200':'200px',
                '230':'230px',
                '277':'277px',
                '280':'280px',
                '330':'330px',
                '357':'357px',
                '507':'507px',
                '550':'550px',
                '600':'600px',
                '616':'616px',
                '620':'620px',
                '651':'651px',
                '670':'670px',
                '680':'680px',
                '700':'700px',
                '709':'709px',
                '764':"764px",
                '1000':'1000px',
                '1200':'1200px',
                '1500':'1500px'
            },
            opacity: {
                '0.75': '.0.75',
            },
            boxShadow: {
                'buttonShadow': '0 4px 4px 0px rgba(0, 0, 0, 0.05)',
                'headBall':'12px 12px 20px 0px #91CBD8',
                'border':'0px 4px 4px 0px rgba(0, 0, 0, 0.05)',
                'item':'6px 6px 0px 0px #91CBD8',
                'depart':'6px 6px 0px 0px #96BDDA',
            },
            spacing: {
                // プラス
                '20':'20px',
                '22':'22px',
                '30':'30px',
                '53':'53px',
                '60':'60px',
                '65':'65px',
                '80':'80px',
                '82':'82px',
                '100':'100px',
                '180':'180px',
                '200':'200px',
                '220':'220px',
                '231':'231px',
                '240':'240px',
                '260':'260px',
                '300':'300px',
                '350':'350px',
                '410':'410px',
                '500':'500px',
                '600':'600px',
                '665':'665px',
                '830':'830px',
                '1050':'1050px',

                // マイナス
                '413':'-313px',
                '650':'-650px',
                '428':'-428px',
                '470':'-470.333px',
                '899':'-899px',
            }
        },

        borderRadius:{
            "button":'99px',
            '1019':'1019px',
            '4':'4px',
            '8':'8px',
            '10':'10px',
            '15':'15px',
            '30':'30px',
            '277':'277px',
        }
    },

    plugins: [forms,require('flowbite/plugin')],
};

