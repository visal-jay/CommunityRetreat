 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 </head>

 <body>
     <style>
         .orange-box {
             height: 80px;
             flex-grow: 1;
             background-color: orange;
             margin: 10px;
         }

         .layout {
             display: flex;
             flex-direction: row;
             justify-content: space-between;
         }

         .grow-twise {
             flex-grow: 2;
         }

         .btn {
             -webkit-text-size-adjust: 100%;
             --balloon-color: rgba(16, 16, 16, 0.95);
             --balloon-font-size: 12px;
             --balloon-move: 4px;
             --diff-background-color: initial;
             --diff-text-color: initial;
             --diff-font-family: Consolas, Courier, monospace;
             --diff-selection-background-color: #b3d7ff;
             --diff-gutter-insert-background-color: #d6fedb;
             --diff-gutter-delete-background-color: #fadde0;
             --diff-gutter-selected-background-color: #fffce0;
             --diff-code-insert-background-color: #eaffee;
             --diff-code-delete-background-color: #fdeff0;
             --diff-code-insert-edit-background-color: #c0dc91;
             --diff-code-delete-edit-background-color: #f39ea2;
             --diff-code-selected-background-color: #fffce0;
             --diff-omit-gutter-line-color: #cb2a1d;
             --color-bg: #f3f7f7;
             --color-bg-2: #e7eeef;
             --color-white: #fff;
             --color-shade-lighter: #f3f7f7;
             --color-shade-light: #e7eeef;
             --color-shade-medium: #b7c9cc;
             --color-shade-dark: #738f93;
             --color-text-light: #b7c9cc;
             --color-text-medium-dark: #39424e;
             --color-text-dark: #0e141e;
             --color-text-dark-faded: #576871;
             --modal-overlay-color: rgba(231, 238, 239, 0.9);
             --active-tab-color: #000;
             --select-border-color: #b3b3b3;
             --font-family-text: OpenSans, Arial, Helvetica, sans-serif;
             --font-family-input: SourceCodePro, monaco, Courier, monospace;
             -webkit-font-smoothing: antialiased;
             --color-dialog-text: var(--color-text-dark-faded);
             --verifiable-skills-columns: 3;
             --mock-test-columns: 3;
             font: inherit;
             margin: 0;
             outline: 0;
             vertical-align: baseline;
             position: relative;
             display: inline-block;
             outline-width: 0;
             cursor: pointer;
             transition: all .5s ease;
             transition-property: box-shadow, background, color, border;
             margin-top: 20px;
             padding: 5px;
             font-weight: 700;
             background-color: var(--color-btn-line-primary-bg, transparent);
             color: var(--color-btn-line-primary-text, #1ba94c);
             border: 1px solid #1ba94c;
             border-color: var(--color-btn-line-primary-border, #1ba94c);
             height: auto;
             font-size: 12px;
         }
     </style>

     <div class="layout">
         <div class="orange-box"></div>
         <div class="orange-box grow-twise"></div>
         <div class="orange-box"></div>
         <div class="orange-box"></div>
         <div class="orange-box"></div>
         <div class="orange-box"></div>
     </div>

     <div class="btn">Test Button<div>
 </body>

 </html>