<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::user()->type =='C')
                NP Bank - Correntista
            @else
                NP Bank - Lojista
            @endif
        </h2>
    </x-slot>

    <!-- Everything on NP Bank happens here :D -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Valor da sua Carteira: <strong><span class="text-success" id="my-wallet-value"></span></strong>
                    <hr/>
                    @if(Auth::user()->type =='C')
                        <button class="btn btn-dark" onclick="transferOptions()" id="transfer-button">Transferir Dinheiro</button>

                        <div id="transfer-options" style="display:none;">
                            <hr/>
                            *Selecione um Destinatário:
                                <br/>
                                <select id="payee-id">
                                    <option value="">Selecione</option>
                                </select>
                            <br/><br/>
                            *Selecione o Valor: 
                                <br/>
                                <input type="number" id="transfer-value">
                            <br/><br/>
                                <button class="btn btn-success" onclick="checkTransaction()">Transferir Agora</button>
                                <button class="btn btn-secondary" onclick="cancelTransfer()">Desistir</button>
                                <small id="validationError" style="display:none; color:red;"></small>
                        </div>

                        <div class="alert text-success" id="transfer-success-alert" style="display:none;"></div>

                        <div class="alert" id="load-transaction" style="display:none;"></div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
