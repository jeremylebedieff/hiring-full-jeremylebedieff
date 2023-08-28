import * as React from 'react';
import { CardProfil } from "../CardProfil/CardProfil";
import { NoFound } from '../../page/NoFound';
import { count } from 'console';


export const ListCard = (props : any): any => {
    const { items, checkAll, search } = props
    if (items?.length > 0) {
        return items.map((card: Object) => {
            return <div className='column'>
                <CardProfil 
                    value={card} 
                    key={card.toString()} 
                    checkAll={checkAll}
                  


                />
            </div>
        })       
    } else if (search !== "" && items?.length === 0) {
        return <NoFound/>
    } else {
        return 'trouve le git le plus beau de ta region '
    }
}