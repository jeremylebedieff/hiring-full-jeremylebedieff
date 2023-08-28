import * as React from 'react';
import './NoFound.css';

export const NoFound = () => {
    return(
    
        <div className='notFoundGif'>
            <h3> Aucun resultat ici, try again !   </h3>
            <img alt='no found' src={process.env.PUBLIC_URL + 'Rvbc.gif'} />
        </div>
        
    )
}

