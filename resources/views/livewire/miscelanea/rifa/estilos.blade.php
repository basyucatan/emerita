    <style>
        :root {
            --canvas-size: 65vw;
            --max-canvas-size: 350px;
        }

        .roulette-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px auto;
            width: 100%;
            max-width: var(--max-canvas-size);
        }

        #rouletteCanvas {
            width: var(--canvas-size) !important;
            height: var(--canvas-size) !important;
            max-width: var(--max-canvas-size);
            max-height: var(--max-canvas-size);
            border: 8px solid #f8f9fa;
            border-radius: 50%;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .grid-numbers {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(30px, 1fr));
            gap: 4px;
        }

        /* CLASE CRÍTICA: !important para ganar a Bootstrap */
        .disabled-number {
            opacity: 0.8 !important;
            background-color: #cf0101 !important;
            color: #ffffff !important;
            text-decoration: line-through !important;
            transform: scale(0.95);
            border-color: transparent !important;
        }

        .tab-pane-custom { display: none; }
        .tab-pane-custom.active { display: block; }

        .winner-badge {
            font-size: 1rem;
            padding: 0.5rem 1rem;
            margin: 5px;
            border-radius: 50px;
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes popIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
