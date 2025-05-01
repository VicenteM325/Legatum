@push('css')
<style>
    .nicho-map-container {
        overflow-x: auto;
        margin-bottom: 20px;
    }
    
    .avenida-row {
        display: flex;
        margin-bottom: 10px;
        align-items: center;
    }
    
    .avenida-label {
        width: 80px;
        font-weight: bold;
        text-align: right;
        padding-right: 10px;
    }
    
    .nicho-row {
        display: flex;
        gap: 5px;
    }
    
    .nicho-cell {
        width: 100px;
    }
    
    .nicho {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        height: 60px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .nicho:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    
    .nicho-code {
        font-size: 12px;
        font-weight: bold;
    }
    
    .nicho-actions {
        display: flex;
        justify-content: space-around;
        margin-top: 5px;
    }
    
    .nicho-actions .btn {
        padding: 0 5px;
        font-size: 10px;
    }
    .tooltip-inner {
        white-space: pre-line;
        text-align: left;
        max-width: 300px;
    }
    
    /* Estados de nichos */
    .disponible { background-color: #d4edda; }
    .ocupado { background-color: #f8d7da; }
    .historico { background-color: #cce5ff; border: 2px dashed #007bff; }
    .empty { background-color: #f8f9fa; color: #6c757d; }
    
    /* Leyenda */
    .legend {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        margin-right: 15px;
    }
    
    .legend-color {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 5px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }
    
    @media (max-width: 768px) {
        .avenida-label {
            width: 60px;
            font-size: 12px;
        }
        
        .nicho-cell {
            width: 80px;
        }
        
        .nicho {
            height: 50px;
        }
    }
</style>
@endpush
